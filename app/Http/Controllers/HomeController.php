<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StolenCarBase;
use Illuminate\Support\Facades\Auth;
use App\Traits\Filters;
use App\Repositories\CarRepository;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $carRepository;

    use Filters;


    public function __construct(CarRepository $carRepository)
    {
        
        $this->middleware(['auth','verified']);

        $this->middleware(function ($request, $next) {
        
        $this->user = Auth::user();

        return $next($request);
        
        });

        $this->carRepository = $carRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        
        $stolenCars = $this->carRepository->getStolenCar($this->user->id);

        $filter = $this->filter($stolenCars);
        
        return view('home', compact('stolenCars', 'filter'));
    } 
 

}
