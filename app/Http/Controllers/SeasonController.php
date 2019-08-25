<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeasonRequest;
use App\models\Season;
use App\Traits\ApiResponser;
use App\Transformers\SeasonTransformer;
use Illuminate\Http\Request;

class SeasonController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    /**
     * SeasonController constructor.
     */


    public function __construct()
    {
       // parent::__construct(); // para ativar auth.api middleware

        $this->middleware('client.credentials')->only(['index','show']);
        $this->middleware('auth.api')->except(['index','show']);

        $this->middleware('transform.input:' . SeasonTransformer::class)->only(['store','update']);

    }

    public function index()
    {
        $seasons = Season::all();
        //return response()->json(['data'=>$seasons]);
        return $this->showAll($seasons);

        //cache
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
    public function store(SeasonRequest $request)
    {

        $season = Season::create($request->all());
        return $this->showOne($season, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\models\Season $season
     * @return \Illuminate\Http\Response
     */
    public function show(Season $season)
    {

        //return response()->json(['data' => $season]);
        return $this->showOne($season);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\models\Season $season
     * @return \Illuminate\Http\Response
     */
    public function edit(Season $season)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\models\Season $season
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Season $season)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\models\Season $season
     * @return \Illuminate\Http\Response
     */
    public function destroy(Season $season)
    {
        $season->delete();
        return $this->showOne($season);
    }
}
