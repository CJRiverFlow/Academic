<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CoursesAPI;
use Cache;
use Log;


class CoursesController extends Controller
{
    public function index()
    {
    return view('index');
    }
}