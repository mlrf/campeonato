<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Validation\ValidationException;

class TransformInput
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $transformer)
    {

        // passa o input do pedido para o transformer, recebe o atributo original,
        // substitui o request pelo atributo original


        //dd( $request->request); // no request vem "season" e queremos alterar para "name"

        $transformedInput = [];
        foreach ($request->request->all() as $input => $value) {
            $transformedInput[$transformer::originalAttributes($input)] = $value;
        }

        $request->replace($transformedInput);

        $response = $next($request);

        if (isset($response->exception)  && $response->exception instanceof ValidationException)  {

            $data = $response->getData();

            $transformedErrors = [];

            //Ex: transform  name attribute into season
            foreach ($data->error as $field => $error) {
                $transformedField = $transformer::transformedAttributes($field);

                $transformedErrors[$transformedField] = str_replace($field, $transformedField, $error);
            }
            dd($transformedErrors);


            $data->error = $transformedErrors;
            $response->setData($data);

        }
        return $response;


    }
}
