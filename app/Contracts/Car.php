<?php

namespace App\Contracts;

/**
 * Interface info car
 */
interface Car
{
    
    public function infoCar($request);

    public function getInfoByVinCode($vin);
}
