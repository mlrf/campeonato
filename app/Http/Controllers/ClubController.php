<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInsertRequest;
use App\models\Club;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ClubController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $clubs = Club::all();

       // $clubs=Club::withTrashed()->get(); //softdelete
        //$clubs=Club::has('players')->get();


        return $this->showAll($clubs);

        //return response()->json(['data' => $clubs], 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illum inate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        Club::create($request->all());
//        return response()->json(['message'=>'Club Created'],201);

        //check api_token

//        if($request->)


        //$this->validate($request);

        $rules = [
            'name' => 'required'
        ];
//
        $this->validate($request, $rules);


//        if ($request->input('api_token') == '8bIhrW4CuMB0rTiU3UeAfe3fxnYApBIeEa3dkMgOrlIfu0ZX884jKHw8Tv8t') {
//            Club::create($request->all());
//            return response()->json(['message' => 'club created'], 201);
//        } else {
//            return response()->json(['error' => 'not authorized'], 403);
//        }


        if ($request->input('api_token') == '8bIhrW4CuMB0rTiU3UeAfe3fxnYApBIeEa3dkMgOrlIfu0ZX884jKHw8Tv8t') {
            $club = Club::create($request->all());
            return $this->showOne($club, 201);
        } else {
            return $this->errorResponse('not authorized',403);
        }






    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        //$club = Club::findOrFail($club);
        //return response()->json(['data'=>$club]);

        return $this->showOne($club);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $club = Club::findOrFail($id);
        $club->name == $request->input('name');
        $club->save();

        return response()->json(['data' => 'club updated'], 200);


//        $user->name=$request->input('name');
//        $user->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club) //Implicit Model Binding
    {
       // $club = Club::findOrFail($id);
        $club->delete();

        return response()->json(['data' => "user deleted"], 200);


    }




}
