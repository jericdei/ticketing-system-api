<?php

namespace App\Services\Common;

use Illuminate\Database\Eloquent\Model;

class ModelService
{
    public function storeModel(Model $model, array $input): Model
    {
        return $model->create($input);
    }

    public function updateModel(Model $model, array $input): Model
    {
        $model->update($input);

        return $model;
    }
}
