<?php

namespace Database\Seeders;

use App\Models\Translation;
use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()
        ->create([
            'email'=>'test@mail.com',
            'password' => Hash::make('password')
        ]);

        Translation::factory()->count(50)->create(['user_id' => $user]);
    }
}
