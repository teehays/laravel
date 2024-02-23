<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class TytnTestController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function getTytnTest(){
        dump("Hello!");
    }
}
