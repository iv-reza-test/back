<?php

namespace Tests\Feature\Model;

use App\Models\Apartment;
use App\Models\Floor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApartmentTest extends TestCase {
    use RefreshDatabase;

    public function testStoreData() {

        $data = Apartment::factory()->make()->toArray();
        Apartment::create($data);

        $this->assertDatabaseHas('apartments', $data);
        $this->assertDatabaseCount('apartments', 1);

    }

    public function testRelationEntranceWithHouse() {
        $data = Apartment::factory()->for(Floor::factory())->create();
        $this->assertTrue(isset($data->floor->id));

    }

}
