<?php

namespace App\Repositories;

use App\Models\StolenCarBase;

class SearchCarRepository
{
    
    /**
     *  Search in StolenCarBase.
     */

    public function search($search){

        if ($search) {

        return StolenCarBase::where(function($q) use($search){

                $q->where('name', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('vin', 'like', "%$search%")
                    ->orWhere('number', 'like', "%$search%")
                    ->orWhere('marka', 'like', "%$search%")
                    ->orWhere('model', 'like', "%$search%")
                    ->orWhere('color', 'like', "%$search%")
                    ->orWhere('year', 'like', "%$search%");
            })->get();
        }
    }
}
