<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {

        return response()->json(Floor::where('entrance_id', $request->query('entrance_id', 1))->latest()->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $res = Floor::create($request->all());

        return response()->json(['message' => 'ok']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {

        return response()->json(Floor::find($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {

        $model = Floor::find($id);

        $model->update(['name' => $request->input('name')]);

        return response()->json(['message' => 'ok']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        Floor::destroy($id);
        return response()->json(['message' => 'ok']);
    }
}
