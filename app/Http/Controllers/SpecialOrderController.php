<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpecialOrderRequest;
use App\Http\Requests\UpdateSpecialOrderRequest;
use App\Models\SpecialOrder;
use Illuminate\Http\Request;

class SpecialOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSpecialOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->all() as $spec) {
            SpecialOrder::create([
                'reference' => $spec['reference'],
                'quantity' => $spec['quantity']
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecialOrder  $specialOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SpecialOrder $specialOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpecialOrder  $specialOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecialOrder $specialOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpecialOrderRequest  $request
     * @param  \App\Models\SpecialOrder  $specialOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecialOrderRequest $request, SpecialOrder $specialOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecialOrder  $specialOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialOrder $specialOrder)
    {
        //
    }
}
