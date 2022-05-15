<?php

namespace App\Repositories;

interface TranslationRepositoryInterface {

    public function all();

    public function findById($id);

    public function create($input);

    public function update($translation, $input);

    public function destroy($translation);
    
}