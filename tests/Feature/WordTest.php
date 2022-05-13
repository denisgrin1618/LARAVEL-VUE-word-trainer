<?php

namespace Tests\Feature;

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
    

    public function testIndexOk()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->get('/api/words');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testStoreOk()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $this->seed();

        $payload = [
            'name' => $this->faker->firstName,
            'language_id'  => Language::where('name', 'en')->first()->id
        ];

        $this->post('/api/words', $payload)
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
             [
                 'data' => [
                     'id',
                     'name',
                     'language_id',
                     'user_id',
                     'created_at',
                     'updated_at'
                 ],
                 'message'
             ]
         );
        $this->assertDatabaseHas('words', $payload);
    }

    public function testStoreValidationFailed()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $payload = [
            'name' => $this->faker->firstName
        ];

        $this->post('/api/words', $payload)
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        
    }

    public function testUpdateOk()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $this->seed();

        $language_id = Language::where('name', 'en')->first()->id;

        $word = Word::create([
            'name' => $this->faker->firstName,
            'language_id' => $language_id,
        ]);

        $payload = [
            'name' => $this->faker->firstName,
            'language_id' => $language_id
        ];

        $this->put("/api/words/{$word->id}", $payload)
        ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('words', $payload);      
    }

    public function testDeleteOk()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $this->seed();

        $language_id = Language::where('name', 'en')->first()->id;

        $payload = [
            'name' => $this->faker->firstName,
            'language_id' => $language_id
        ];

        $word = Word::create($payload);

        $this->delete("/api/words/{$word->id}")
        ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseMissing('words', $payload);      
    }

}
