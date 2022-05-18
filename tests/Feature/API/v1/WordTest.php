<?php

namespace Tests\Feature\API\v1;

use App\Models\Language;
use App\Models\User;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Http\Response;

class WordTest extends TestCase
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
        $response = $this->get('/api/v1/words');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testStoreOk()
    {
        $payload = [
            'name' => $this->faker->firstName,
            'language_id'  => $this->language_en->id
        ];

        $this->post('/api/v1/words', $payload)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('words', $payload);
    }

    public function testStoreValidationFailed()
    {
        $payload = [
            'name' => $this->faker->firstName
        ];

        $this->post('/api/v1/words', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUpdateOk()
    {
        $word = Word::create([
            'name' => $this->faker->firstName,
            'language_id' => $this->language_en->id,
        ]);

        $payload = [
            'name' => $this->faker->firstName,
            'language_id' => $this->language_en->id
        ];

        $this->put("/api/v1/words/{$word->id}", $payload)
            ->assertStatus(Response::HTTP_ACCEPTED);

        $this->assertDatabaseHas('words', $payload);
    }

    public function testDeleteOk()
    {
        $payload = [
            'name' => $this->faker->firstName,
            'language_id' => $this->language_en->id
        ];

        $word = Word::create($payload);

        $this->delete("/api/v1/words/{$word->id}")
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('words', $payload);
    }
}
