<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Floor;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $houses = House::latest()->get();

        foreach ($houses as $row){

            $row->count_entrance = $row->entrances->count();
            $row->count_floor = Floor::whereIn('entrance_id' , $row->entrances->pluck('id'))->count();
            $row->count_apartment = Apartment::whereIn(
                'floor_id' ,
                Floor::whereIn('entrance_id' , $row->entrances->pluck('id'))->pluck('id')
            )->count() ;

        }

        return response()->json($houses);

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
    public function show(int $id) {

        return response()->json(House::find($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id) {

        $model = House::find($id);

        $model->update(['name'=> $request->input('name') , 'street' => $request->input('street')]);

        return response()->json(['message'=>'ok']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) {
        House::destroy($id);
        return response()->json(['message'=>'ok']);
    }
}
