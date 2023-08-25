<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {

        return response()->json(House::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $res = House::create($request->all());

        return response()->json(['message' => 'ok']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        House::destroy($id);
        return response()->json(['message'=>'ok']);
    }
}
