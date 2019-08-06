<?php

use App\models\Club;
use App\models\Player;
use App\models\Season;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(Club::class,10)->create();


        Club::flushEventListeners();
        Player::flushEventListeners();
        Season::flushEventListeners();

       // Solução 1 : Usar a relação e para cada club criar um player

//        factory(App\models\Club::class, 3)->create()->each(function ($club) {
//            //for ($i=0; $i<=3;$i++){
//                $club->players()->save(factory(App\models\Player::class)->make());
//            //}
//
//        });


        //factory(App\models\Club::class,5)->create();


        //Solução 2: Executar as duas factories à parte sendo que a factory do player vai buscar um club_id válido ao model club


        factory(App\models\Club::class,3)->create();
        factory(App\models\Player::class,100)->create();

    }
}
