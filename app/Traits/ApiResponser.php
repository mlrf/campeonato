<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

        $collection = $this->transformData($collection, $transformer);

//        return $this->successResponse(['data' => $collection], $code);
        return $this->successResponse($collection, $code);
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
        foreach (request()->query() as $query=>$value){
            $attribute=$transformer::originalAttributes($query);
        }

        if (isset($attribute,$value)){
            $collection=$collection->where($attribute,$value);
        }

        return $collection;
    }
}

