<?php

namespace App\Repositories;

use App\Models\Makes;
use App\Models\Models;
use App\Services\AutomaticUpdateService;

class AutomaticUpdateRepository
{
    /**
     * Update data makes one time monthly.
     */

    public static function updateMakes($makesData) {

    $makes = new Makes;

    foreach ($makesData as $makeData) {
        
        $makes->update($makeData->toArray());

        }
    }
    
    /**
     *  Get id makes one time monthly.
     */

    public static function getMakesById(){

        $makesId = Makes::query()
                        ->select('make_id')
                        ->where('id', 2)
                        ->first()
                        ->toArray();

        AutomaticUpdateService::getModelsForMakeId($makesId);


    }

    /**
     *  Update models one time monthly.
     */

    public static function updateModels($modelsDataById){

        $makes = new Models; 

        $makes-> update([

                    'make_id' => $modelsDataById['Make_ID'],
                    'model_id' => $modelsDataById['Model_ID'],
                    'model_name' => $modelsDataById['Model_Name'],

                ]);
    }
}
