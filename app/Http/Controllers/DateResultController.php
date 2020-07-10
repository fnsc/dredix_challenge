<?php

namespace App\Http\Controllers;

use App\DateResult;
use Illuminate\Http\Request;

class DateResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $dateResults = new DateResult;
            return $dateResults->search(request()->all());
        }

        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(request()->all());
    }
}
