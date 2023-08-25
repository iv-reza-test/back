<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {

        return response()->json(House::latest()->get());

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

        return response()->json(House::find($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {

        $model = House::find($id);

        $model->update(['name'=> $request->input('name') , 'street' => $request->input('street')]);

        return response()->json(['message'=>'ok']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        House::destroy($id);
        return response()->json(['message'=>'ok']);
    }
}
