<?php

namespace App\Repositories;

use App\Models\Word;

class WordRepository implements WordRepositoryInterface {

    public function all()
    {
        return Word::whereCurrentUser()->get();      
    }

    public function findById($id){

        return Word::whereCurrentUser()
                    ->where('id', $id)
                    ->get();
    }

    public function create($input)
    {
        return Word::create($input);
    }

    public function update($wordId, $input)
    {
        $word = Word::whereCurrentUser()
                ->where('id', $wordId)
                ->firstOrFail();

        $word->update($input);

        return $word;
    }

    public function destroy($wordId){

        $word = Word::whereCurrentUser()
            ->where('id', $wordId)
            ->firstOrFail();

        $word->delete();
    }
    
}