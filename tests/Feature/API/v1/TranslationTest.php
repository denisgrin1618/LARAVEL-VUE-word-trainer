<?php

namespace Tests\Feature\API\v1;

use App\Models\Language;
use App\Models\Translation;
use App\Models\User;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Http\Response;

class TranslationTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $user;
    private $language_en;
    private $language_ru;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=LanguageSeeder');
        // $this->seed();

        $this->language_en = Language::where('name', 'en')->first();
        $this->language_ru = Language::where('name', 'ru')->first();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function testIndexOk()
    {
        $response = $this->get('/api/v1/translations');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testStoreOk()
    {
        $word_origin = Word::factory()
            ->create([
                'user_id' => $this->user->id,
                'language_id' => $this->language_en
            ]);

        $word_translation = Word::factory()
            ->create([
                'user_id' => $this->user->id,
                'language_id' => $this->language_ru
            ]);

        $payload = [
            'word_origin_id' => $word_origin->id,
            'word_translation_id'  => $word_translation->id
        ];

        $this->post('/api/v1/translations', $payload)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('translations', $payload);
    }

    public function testStoreValidationFailed()
    {
        $payload = [
            'name' => $this->faker->firstName
        ];

        $this->post('/api/v1/translations', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUpdateOk()
    {

        $word1 = Word::factory()->for($this->user)->create(['language_id' => $this->language_en]);
        $word2 = Word::factory()->for($this->user)->create(['language_id' => $this->language_ru]);
        $word3 = Word::factory()->for($this->user)->create(['language_id' => $this->language_ru]);

        $translation = Translation::factory()
            ->for($this->user)
            ->create([
                'word_origin_id' => $word1->id,
                'word_translation_id' => $word2->id,
            ]);

        $payload = [
            'word_origin_id' => $word1->id,
            'word_translation_id' => $word3->id
        ];

        $this->put("/api/v1/translations/{$translation->id}", $payload)
            ->assertStatus(Response::HTTP_ACCEPTED);

        $this->assertDatabaseHas('translations', $payload);
    }

    public function testDeleteOk()
    {
        $word1 = Word::factory()->for($this->user)->create(['language_id' => $this->language_en]);
        $word2 = Word::factory()->for($this->user)->create(['language_id' => $this->language_ru]);

        $payload = [
            'word_origin_id' => $word1->id,
            'word_translation_id' => $word2->id,
        ];
        $translation = Translation::factory()
            ->for($this->user)
            ->create($payload);

        $this->delete("/api/v1/translations/{$translation->id}")
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('translations', $payload);
    }
}
