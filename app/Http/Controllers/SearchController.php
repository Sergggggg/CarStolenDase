<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SearchCarRepository;
use App\Http\Requests\SearchDataRequest;

class SearchController extends Controller
{

	protected $search;
	protected $stolenCarBase;
	public $searchResults;

	function __construct(Request $request, SearchCarRepository $searchCarRepository)
    {
     
		$this->search = $request->get('q');
		$this->searchCarRepository = $searchCarRepository;
    }

    /**
     *  view searched data.
     */
    
    public function index(SearchDataRequest $searchDataRequest){

    	$searchResults = $this->searchCarRepository->search($this->search);

    	return view('search')->with('searchResults', $searchResults);
    }
}
