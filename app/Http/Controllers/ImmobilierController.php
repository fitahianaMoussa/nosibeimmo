<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImmobilierRequest;
use App\Http\Requests\UpdateImmobilierRequest;
use App\Models\Immobilier;

class ImmobilierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreImmobilierRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Immobilier $immobilier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Immobilier $immobilier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImmobilierRequest $request, Immobilier $immobilier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Immobilier $immobilier)
    {
        //
    }
}
