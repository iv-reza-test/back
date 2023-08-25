<?php

namespace Tests\Feature\Controller;

use App\Models\Entrance;
use App\Models\Floor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FloorControllerTest extends TestCase {

    use RefreshDatabase;

    public function testIndex() {
        Floor::factory(5)->create();

        $forModel = Entrance::factory()->create();
        Floor::factory(5)->for($forModel)->create();


        $forModelRes = Floor::where('entrance_id' ,$forModel->id)->latest()->get();

        $response = $this->getJson('/api/floors?entrance_id='.$forModel->id);
        $response->assertStatus(200);
        $response->assertExactJson($forModelRes->toArray());
    }

    public function testShow() {
        $model = Floor::factory()->create();

        $response = $this->getJson('/api/floors/'.$model->id);
        $response->assertStatus(200);
        $response->assertExactJson($model->toArray());
    }

    public function testDestroy(){
        $model = Floor::factory()->create();

        $this->deleteJson('/api/floors/'.$model->id);

        $this->assertDatabaseCount('floors' , 0);

    }

    public function testStore(){
        $factory = Floor::factory()->make();

        $res = $this->postJson('/api/floors' , $factory->toArray());

        $model = Floor::all()->first();

        $this->assertDatabaseHas('floors' , $factory->toArray());

        $res->assertOk();

    }

    public function testUpdate(){
        $factory = Floor::factory()->create();

        $res = $this->putJson('/api/floors/'.$factory->id , ['name' => 'soltan']);

        $model = Floor::find($factory->id);

        $this->assertDatabaseHas('floors' , ['name' => 'soltan']);

        $res->assertOk();

    }
}
