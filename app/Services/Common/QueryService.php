<?php

namespace App\Services\Common;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class QueryService
{
    public function getSingle(Model $model): Model
    {
        return QueryBuilder::for($model)
            ->allowedFields($model->getAllowedFields())
            ->allowedIncludes($model->getAllowedIncludes())
            ->firstOrfail();
    }

    public function getMultiple(Model $model, Request $request): Model
    {
        $query = QueryBuilder::for($model);
        if ($request->has('fields')) {
            $query->allowedFields($request->get('fields'));
        }

        if ($request->has('filter')) {
            $query->allowedFilters($request->get('filter'));
        }

        if ($request->has('sort')) {
            $query->allowedSorts($request->get('sort'));
        }

        if ($request->has('include')) {
            $query->allowedIncludes($request->get('include'));
        }

        if ($request->has('limit')) {
            return $query->jsonPaginate($request->get('limit'));
        }

        return $query->get();
    }
}
