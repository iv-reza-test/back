<?php

namespace Tests\Feature\Controller;

use App\Models\House;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HouseControllerTest extends TestCase {

    use RefreshDatabase;

    public function testIndex() {
        House::factory(5)->create();

        $model = House::all();

        $response = $this->getJson('/api/houses');
        $response->assertStatus(200);
        $response->assertExactJson($model->toArray());
    }
}
