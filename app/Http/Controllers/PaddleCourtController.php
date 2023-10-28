<?php

namespace App\Http\Controllers;

use App\Models\PaddleCourt;
use Illuminate\Http\Request;

class PaddleCourtController extends Controller
{

    public function index()
    {
        $paddleCourt = PaddleCourt::all();
        return view('paddleCourt.index',compact('paddleCourt'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($paddleCourt_id)
    {
        $paddleCourt = PaddleCourt::find($paddleCourt_id);
        return view('paddleCourt.show',compact('paddleCourt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaddleCourt $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaddleCourt $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaddleCourt $product)
    {
        //
    }
}
