<?php

namespace App\Repositories;

use App\Models\Word;

class WordRepository implements WordRepositoryInterface {

    public function all()
    {
        return Word::whereCurrentUser()
            ->filter(request())
            ->get();      
    }

    public function findById($id){

        return Word::whereCurrentUser()
                    ->where('id', $id)
                    ->get();
    }

    public function create($input)
    {
        $word = Word::whereCurrentUser()
            ->where('name', 'like', "%{$input['name']}%")
            ->first();

        return $word ?? Word::create($input);
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