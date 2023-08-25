<?php

namespace Tests\Feature\Controller;

use App\Models\Entrance;
use App\Models\House;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntranceControllerTest extends TestCase {

    use RefreshDatabase;

    public function testIndex() {
        Entrance::factory(5)->create();

        $forModel = House::factory()->create();
        Entrance::factory(5)->for($forModel)->create();


        $forModelRes = Entrance::where('house_id' ,$forModel->id)->latest()->get();

        $response = $this->getJson('/api/entrances?house_id='.$forModel->id);
        $response->assertStatus(200);
        $response->assertExactJson($forModelRes->toArray());
    }

    public function testShow() {
        $model = Entrance::factory()->create();

        $response = $this->getJson('/api/entrances/'.$model->id);
        $response->assertStatus(200);
        $response->assertExactJson($model->toArray());
    }

    public function testDestroy(){
        $model = Entrance::factory()->create();

        $this->deleteJson('/api/entrances/'.$model->id);

        $this->assertDatabaseCount('entrances' , 0);

    }

    public function testStore(){
        $factory = Entrance::factory()->make();

        $res = $this->postJson('/api/entrances' , $factory->toArray());

        $model = Entrance::all()->first();

        $this->assertDatabaseHas('entrances' , $factory->toArray());

        $res->assertOk();

    }

    public function testUpdate(){
        $factory = Entrance::factory()->create();

        $res = $this->putJson('/api/entrances/'.$factory->id , ['name' => 'soltan']);

        $model = Entrance::find($factory->id);

        $this->assertDatabaseHas('entrances' , ['name' => 'soltan']);

        $res->assertOk();

    }
}
