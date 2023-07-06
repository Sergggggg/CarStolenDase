<?php

namespace App\Repositories;

use App\Models\StolenCarBase;
use Illuminate\Support\Facades\Auth;

class CarRepository
{
    /**
     *  Save data avto to database
     */

    public function addCarInfoToDataBase($request, $CarInfoByVin){

            $avtoData = array_merge($request, $CarInfoByVin);
            
            StolenCarBase::insert([$avtoData]);
    }

    /**
     *  Get info car to edit.
     */

    public function getInfoCar($id){

        $user = Auth::user();

        return      StolenCarBase::query()
                        ->where('user_id', $user->id)
                        ->where('id', $id)
                        ->first();
    }

    /**
     *  Save editted record to stolen car base.
     */


    public function saveEdittedData($request){

        $stolenCarBase = $this->getInfoCar($request['id']);

        $stolenCarBase->update($request);
    }

    /**
     * Get Stolen car by user id.
     */

    public function getStolenCar($user_id)
    {

        return      StolenCarBase::query()
                            ->where('user_id', $user_id)
                            ->orderBy('name')
                            ->paginate(10);
    }


    /**
     *  Delete data from StolenCarBase.
     */

    public function delete($deleteId){

        StolenCarBase::where('id', $deleteId)->delete(); 
    }
}
