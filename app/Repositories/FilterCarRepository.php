<?php

namespace App\Repositories;

use App\Models\StolenCarBase;

class FilterCarRepository
{
    

    /**
     * Get Stolen car by user id.
     */

    public function carBase($id){
 
        return StolenCarBase::query()->where('user_id', $id);

    }

    /**
     *  Filter by fields.
     */

    public function filterByFields($filtersID){

        return StolenCarBase::whereIn('id', $filtersID);
    }
}