<?php

namespace Tests\Feature\Controller;

use App\Models\Apartment;
use App\Models\Floor;
use App\Models\House;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HouseControllerTest extends TestCase {

    use RefreshDatabase;

    public function testIndex() {
        House::factory(5)->create();

        $model = House::all();

        foreach ($model as $row){

            $row->count_entrance = $row->entrances->count();
            $row->count_floor = Floor::whereIn('entrance_id' , $row->entrances->pluck('id'))->count();
            $row->count_apartment = Apartment::whereIn(
                'floor_id' ,
                Floor::whereIn('entrance_id' , $row->entrances->pluck('id'))->pluck('id')
            )->count() ;

        }

        $response = $this->getJson('/api/houses');
        $response->assertStatus(200);
        $response->assertExactJson($model->toArray());
    }

    public function testShow() {
        $model = House::factory()->create();

        $response = $this->getJson('/api/houses/'.$model->id);
        $response->assertStatus(200);
        $response->assertExactJson($model->toArray());
    }

    public function testDestroy(){
        $model = House::factory()->create();

        $this->deleteJson('/api/houses/'.$model->id);

        $this->assertDatabaseCount('houses' , 0);

    }

    public function testStore(){
        $factory = House::factory()->make();

        $res = $this->postJson('/api/houses' , $factory->toArray());

        $model = House::all()->first();

        $this->assertDatabaseHas('houses' , $factory->toArray());

        $res->assertOk();

    }

    public function testUpdate(){
        $factory = House::factory()->create();

        $res = $this->putJson('/api/houses/'.$factory->id , ['name' => 'soltan']);

        $model = House::find($factory->id);

        $this->assertDatabaseHas('houses' , ['name' => 'soltan']);

        $res->assertOk();

    }


}
