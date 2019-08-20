<?php

namespace App\Http\Controllers;

use App\models\Player;

// use App\Repository\Players; assim dá erro
//use Facades\App\Repository\Players;


use Illuminate\Http\Request;

class PlayerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        parent::__construct(); //ativa middleware auth com o routeMiddleware api (que por sua vez usa o guard passport

        $this->middleware('client.credentials')->only(['index']);
    }

    public function index()
    {

        $players = Player::all();
        return $this->showAll($players);

        //return $this->paginate($players);


        //cache using the repository folder

//        $players=Players::all("name");
//        return response()->json(['data'=>$players]);

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        return $this->showOne($player);

        //cache using the Players repository

        //return Players::get($player->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();

        return response()->json(['data' => "player deleted"], 200);
    }
}
