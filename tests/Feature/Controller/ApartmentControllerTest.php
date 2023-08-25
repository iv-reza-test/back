<?php

namespace Tests\Feature\Controller;

use App\Models\Apartment;
use App\Models\Floor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApartmentControllerTest extends TestCase {
    use RefreshDatabase;

    public function testIndex() {
        Apartment::factory(5)->create();

        $forModel = Floor::factory()->create();
        Apartment::factory(5)->for($forModel)->create();


        $forModelRes = Apartment::where('floor_id', $forModel->id)->latest()->get();

        $response = $this->getJson('/api/apartments?floor_id=' . $forModel->id);
        $response->assertStatus(200);
        $response->assertExactJson($forModelRes->toArray());
    }

    public function testShow() {
        $model = Apartment::factory()->create();

        $response = $this->getJson('/api/apartments/' . $model->id);
        $response->assertStatus(200);
        $response->assertExactJson($model->toArray());
    }

    public function testDestroy() {
        $model = Apartment::factory()->create();

        $this->deleteJson('/api/apartments/' . $model->id);

        $this->assertDatabaseCount('apartments', 0);

    }

    public function testStore() {
        $factory = Apartment::factory()->make();

        $res = $this->postJson('/api/apartments', $factory->toArray());

        $model = Apartment::all()->first();

        $this->assertDatabaseHas('apartments', $factory->toArray());

        $res->assertOk();

    }

    public function testUpdate() {
        $factory = Apartment::factory()->create();

        $res = $this->putJson('/api/apartments/' . $factory->id, ['name' => 'soltan']);

        $model = Apartment::find($factory->id);

        $this->assertDatabaseHas('apartments', ['name' => 'soltan']);

        $res->assertOk();

    }
}
