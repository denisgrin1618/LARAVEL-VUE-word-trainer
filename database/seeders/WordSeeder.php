<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'test@mail.com')->first();

        Word::factory()
            ->count(100)
            ->state(new Sequence(
                ['language_id' => 1],
                ['language_id' => 2],
            ))
            ->create([
                'user_id' => $user->id
            ]);
    }
}
