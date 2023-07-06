<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StolenAvtoRequest;
use App\Services\StolenAvtoService;
use App\Http\Requests\EditAvtoRequest;
use App\Repositories\CarRepository;

class StolenAvtoController extends Controller
{

	protected $stolenAvtoService;

	function __construct(StolenAvtoService $stolenAvtoService,
						 CarRepository $carRepository)
    {
    
    	$this->stolenAvtoService = $stolenAvtoService;
    	$this->carRepository = $carRepository;
      
    }

   /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */

    public function create(){

		return view('formAddToBase');
    }

   /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
   
    public function store(StolenAvtoRequest $stolenAvtoRequest){

    	$this->stolenAvtoService->infoCar($stolenAvtoRequest); 

		return redirect()->route('home')->with('success','Item created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     */

    public function edit($id)
    {

		$infoCarToEdit = $this->carRepository->getInfoCar($id);

        return view('edit', compact('infoCarToEdit', 'id'));
    }


   /**
     * Update the specified resource in storage.
     *
     */

    public function update(EditAvtoRequest $editAvtoRequest)
    {
    	$this->carRepository->saveEdittedData($editAvtoRequest->except('_token', '_method'));

	    return redirect()->route('home')->with('success','Item edit successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     */

    public function destroy($id)
    {    
        $this->carRepository->delete($id);
    
        return redirect()->route('home')->with('success','Record was deleted successfully!');
    }
}
