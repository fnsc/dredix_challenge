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
        request()->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        return DateResult::create([
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'result' => $this->calculate()
        ]);
    }

    /**
     *
     */
    protected function calculate()
    {
        return (strtotime(request('start_date')) - strtotime(request('end_date'))) / 86400;
    }
}
