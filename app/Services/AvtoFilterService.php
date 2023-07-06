<?php

namespace App\Services;

use App\Repositories\FilterCarRepository;


class AvtoFilterService
{

    function __construct(FilterCarRepository $filterCarRepository)
    {

        $this->filterCarRepository = $filterCarRepository;
    }

    /**
     *  Filters data.
     */

    public function filtersData($stolenCarBase, $request){

        $filtersID = [];
        
        if($request->marka)
            $filtersID=$request->marka;
    
        if($request->model)
            $filtersID=array_merge($filtersID, $request->model);
    
        if($request->year)
            $filtersID = array_merge($filtersID, $request->year);


        $this->filterCarRepository->filterByFields(array_unique($filtersID));


    }
}
