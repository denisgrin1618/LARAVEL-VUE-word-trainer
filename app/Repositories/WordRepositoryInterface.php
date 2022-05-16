<?php

namespace App\Repositories;

interface WordRepositoryInterface {

    public function all();

    public function findById($id);

    public function create($input);

    public function update($wordId, $input);

    public function destroy($wordId);
    
}