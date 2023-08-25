<?php

namespace App\Http\Controllers;

use App\Models\Entrance;
use Illuminate\Http\Request;

class EntranceController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {

        return response()->json(Entrance::where('house_id' , $request->query('house_id' , 1))->latest()->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $res = Entrance::create($request->all());

        return response()->json(['message' => 'ok']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {

        return response()->json(Entrance::find($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {

        $model = Entrance::find($id);

        $model->update(['name' => $request->input('name')]);

        return response()->json(['message' => 'ok']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        Entrance::destroy($id);
        return response()->json(['message' => 'ok']);
    }
}
