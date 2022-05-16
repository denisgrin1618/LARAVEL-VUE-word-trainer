<?php

namespace App\Repositories;

use App\Models\Word;

interface WordRepositoryInterface {

    public function all();

    public function findById($id);

    public function create($input);

    public function update(Word $word, $input);

    public function destroy(Word $word);
    
}