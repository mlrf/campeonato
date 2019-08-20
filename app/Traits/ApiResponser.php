<?php


namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }

        $transformer = $collection->first()->transformer;// transforma o 1ºm para saber como é que se transforma

        $collection = $this->filterData($collection, $transformer);//antes de transformar os dados
        $collection = $this->sortData($collection, $transformer);//antes de transformar os dados
        $collection = $this->paginate($collection);
        $collection = $this->transformData($collection, $transformer);


//        return $this->successResponse(['data' => $collection], $code);
        return $this->cacheResponse($collection);
    }

    protected function showOne(Model $instance, $code = 200)
    {
        $transformer = $instance->transformer; // saca o transformer a partir do  model
        $instance = $this->transformData($instance, $transformer); //transformo

        return $this->successResponse($instance, $code);
    }

    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray();
    }


    protected function sortData(Collection $collection, $transformer)
    {
        if (request()->has('sort_by')) {
            $attribute = $transformer::originalAttributes(request()->sort_by);//mapear atributos do url com os originais

            $collection = $collection->sortBy($attribute);
        }
        return $collection;
    }

    protected function filterData($collection, $transformer)
    {
        //loop throught every request parameter
        foreach (request()->query() as $query => $value) {
            $attribute = $transformer::originalAttributes($query);
        }

        if (isset($attribute, $value)) {
            $collection = $collection->where($attribute, $value);
        }

        return $collection;
    }

    protected function paginate(Collection $collection)
    {
        $rules = [
            'per_page' => 'integer|min:2|max:50',
        ];

//      Classe Validator permite validar um request passando-lhe  $rules
        Validator::make(request()->all(), $rules);

        $page = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 20;

        if (request()->has('per_page')) {
            $perPage = (int)request()->per_page;

        }

        //slice the collection: //page 1 = page 0
        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        $paginated->appends(request()->all()); // Para incluir todos os parametros do request (ex: sort_by)
        return $paginated;
    }

    protected function cacheResponse($data)
    {
        $url=request()->url();
        $queryParams=request()->query(); //saca parametros do get


        ksort($queryParams); //ordena os parametros do url (o user pode colocar primeiro o sort_by e depois a page ou ao contrário mas a cache tem de agir igual para os dois)
        $queryString= http_build_query($queryParams);

        $fullUrl="{$url}?{$queryString}";
        //dd($fullUrl);

        cache()->clear();

        return cache()->remember($fullUrl, Carbon::now()->addMinutes(1), function () use($data) {
            return $data;
        });

    }
}

