<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Repositories\AutomaticUpdateRepository;

class AutomaticUpdateService
{

    /**
     * Get data makes one time monthly.
     */

    public static function getDataMakes(){
        
        $makesData = Http::get('https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json')
                            ->collect(['Results'])->chunk(250)->toArray();

        AutomaticUpdateRepository::updateMakes($makesData);
        AutomaticUpdateRepository::getMakesById();

    }

    /**
     *  Get id makes one time monthly.
     */ 

    public static function getModelsForMakeId($makesId){

        $modelsDataById = Http::get('https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeid/'
                                    .$makesId['make_id']
                                    .'?format=json')
                ->collect(['Results'])->collapse();
         
        AutomaticUpdateRepository::updateModels($modelsDataById);
    }

}
