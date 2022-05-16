<?php

namespace App\Repositories;

use App\Models\Translation;
use App\Models\Word;

class TranslationRepository implements TranslationRepositoryInterface {

    public function all()
    {
        return Translation::whereCurrentUser()
            ->filter(request())
            ->get();      
    }

    public function findById($id){

        return Translation::whereCurrentUser()
                    ->where('id', $id)
                    ->get();
    }

    public function create($input)
    {
        return Translation::create($input);
    }

    public function update($translation, $input)
    {
        $translation->update($input);

        return $translation->fresh();
    }

    public function destroy($translation){

        $translation->delete();
    }
    
}