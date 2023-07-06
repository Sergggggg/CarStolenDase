<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Filters;
use App\Repositories\FilterCarRepository;
use App\Services\AvtoFilterService;

class FilterController extends Controller
{
    use Filters;

	function __construct(FilterCarRepository $filterCarRepository,
						 AvtoFilterService $avtoFilterService)
    {

    	$this->filterCarRepository = $filterCarRepository;
    	$this->avtoFilterService = $avtoFilterService;
    }

    /**
     *  Show filtered data.
     */

    public function index(Request $request){

    	$user = Auth::user();

    	$stolenCarBase = $this->filterCarRepository->carBase($user->id);

		$this->avtoFilterService->filtersData($stolenCarBase, $request);

	        return view('filter', ['carBaseData'=>$stolenCarBase->get(), 
    							   'filter' =>$this->filter($stolenCarBase->get()), 
    							   'checked'=> $request->query()
    							  ]
						);
    }
}
