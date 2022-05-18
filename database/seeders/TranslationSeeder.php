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
        foreach (User::all() as $user) {

            $iterator1 = Word::where('user_id', $user->id)
                ->where('language_id', 1)
                ->get()
                ->getIterator();

            $iterator2 = Word::where('user_id', $user->id)
                ->where('language_id', 2)
                ->get()
                ->getIterator();

            while ($iterator1->valid() && $iterator2->valid()) {
                Translation::factory()
                    ->for($user)
                    ->create([
                        'word_origin_id' => $iterator1->current(),
                        'word_translation_id' => $iterator2->current(),
                    ]);
                $iterator1->next();
                $iterator2->next();
            }
        }
    }
}
