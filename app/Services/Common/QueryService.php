<?php

namespace App\Services\Common;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class QueryService
{
    protected $filterOperators = [
        'eq' => '=',
        'neq' => '!=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
        'in' => 'IN',
        'lk' => 'LIKE',
        'nl' => 'NOT LIKE',
        'bw' => 'BETWEEN'
    ];

    public function getSingle(Model $model, Request $request): Model
    {
        $query = $this->filterFieldsRelations($model::query(), $model, $request);

        return $query->where('id', $model->id)->firstOrFail();
    }

    public function getMultiple(Model $model, Request $request): Collection|LengthAwarePaginator
    {
        $query = $this->filterFieldsRelations($model::query(), $model, $request);

        if ($request->has('filter')) {
            $query = $this->filterModels($query, $model, $request->get('filter'));
        }

        if ($request->has('sort')) {
            $query = $this->sortModels($query, $model, $request->get('sort'));
        }

        if ($request->has('limit')) {
            $query = $query->paginate($request->get('limit'));

            return $query->appends($request->query());
        }

        return $query->get();
    }

    public function filterFields(Builder $query, Model $model, array $fields): Builder
    {
        return $query->select(explode(',', $fields[$model->getTable()]) ?? null);
    }

    public function includeRelations(Builder $query, Model $model, Request $request): Builder
    {
        $includes = explode(',', $request->get('include'));
        $fields = $request->get('fields') ?? null;

        foreach ($includes as $include) {
            // If the requested relation is allowed
            if (in_array($include, $model->getAllowedIncludes())) {
                // If the requested relation has specified fields
                if ($fields && array_key_exists($include, $fields)) {
                    $query->with("{$include}:{$fields[$include]}");
                } else {
                    $query->with($include);
                }
            }
        }

        return $query;
    }

    public function filterModels(Builder $query, Model $model, array $filters): Builder
    {
        // Parse query string filters to array
        foreach ($filters as $key => $value) {
            $field = strtok($key, ':');
            $operator = substr($key, strpos($key, ':') + 1);
            $toFilter[] = compact('field', 'operator', 'value');
        }

        foreach ($toFilter as $filter) {
            if (in_array($filter['field'], $model->getAllowedFilters())) {
                switch($filter['operator']) {
                    case 'in': // WHERE IN
                        $query->whereIn($filter['field'], explode(',', $filter['value']));
                        break;

                    case 'lk': // WHERE LIKE
                    case 'nl': // WHERE NOT LIKE
                        $query->where($filter['field'], $this->filterOperators[$filter['operator']], "%{$filter['value']}%");
                        break;

                    case 'bw': // WHERE BETWEEN
                        $query->whereBetween($filter['field'], explode(',', $filter['value']));
                        break;

                    default: // WHERE =, !=, <, <=, >, >=
                        $query->where($filter['field'], $this->filterOperators[$filter['operator']], $filter['value']);
                        break;
                }
            }
        }

        return $query;
    }

    public function sortModels(Builder $query, Model $model, string $sorts): Builder
    {
        $sorts = explode(',', $sorts);

        foreach ($sorts as $sort) {
            $field = str_replace('-', '', $sort);
            $order = substr($sort, 0, 1) === '-' ? 'DESC' : 'ASC';

            if (in_array($field, $model->getAllowedSorts())) {
                $query->orderBy($field, $order);
            }
        }

        return $query;
    }

    public function filterFieldsRelations(Builder $query, Model $model, Request $request): Builder
    {
        if ($request->has('fields')) {
            $query = $this->filterFields($query, $model, $request->get('fields'));
        }

        if ($request->has('include')) {
            $query = $this->includeRelations($query, $model, $request);
        }

        return $query;
    }
}
