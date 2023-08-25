<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {

        return response()->json(Apartment::where('floor_id', $request->query('floor_id', 1))->latest()->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $res = Apartment::create($request->all());

        return response()->json(['message' => 'ok']);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) {

        return response()->json(Apartment::find($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id) {

        $model = Apartment::find($id);

        $model->update(['name' => $request->input('name')]);

        return response()->json(['message' => 'ok']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) {
        Apartment::destroy($id);
        return response()->json(['message' => 'ok']);
    }
}
