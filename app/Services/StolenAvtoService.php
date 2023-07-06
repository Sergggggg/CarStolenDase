<?php

namespace App\Services;

use App\Contracts\Car;
use Illuminate\Support\Facades\Http;
use App\Repositories\CarRepository;


class StolenAvtoService implements Car
{

    protected $CarRepository;

    function __construct(CarRepository $CarRepository)
    {
      
        $this->CarRepository = $CarRepository; 
    }
    
    /**
     *  Get all info car via API
     */

    public function infoCar($request){
            
        $CarInfoByVin = $this->getInfoByVinCode($request->vin);

        $this->CarRepository->addCarInfoToDataBase($request->except('_token'), $CarInfoByVin);          
    }

     /**
     *  Get info car via API
     */

    public function getInfoByVinCode($vin){

        $infoByVin = Http::get('https://vpic.nhtsa.dot.gov/api/vehicles/decodevin/'
                                    .$vin.'?format=json')->collect(['Results']);
   
        $infoByVin = $infoByVin->map(function ($answer){

                        switch ($answer['Variable']){
                            
                            case "Make":
                            return ['marka'=> $answer['Value']];
                            break;

                            case "Model":
                            return ['model'=> $answer['Value']];
                            break;

                            case "Model Year": 
                            return ['year'=> $answer['Value']];
                            break;

                        }

            })->filter()->collapse()->all();
  
        return $infoByVin;
    }
}
