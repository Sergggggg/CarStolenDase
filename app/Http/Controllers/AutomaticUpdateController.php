<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\AutomaticUpdateService;

class AutomaticUpdateController extends Controller
{

    public static function index(){

    	AutomaticUpdateService::getDataMakes();
    }

}