<?php

namespace Tests\Feature\Model;

use App\Models\Entrance;
use App\Models\House;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HouseTest extends TestCase {

    use RefreshDatabase;

    public function testStoreData() {

        $data = House::factory()->make()->toArray();
        House::create($data);

        $this->assertDatabaseHas('houses', $data);
        $this->assertDatabaseCount('houses', 1);

    }

    public function testRelationHouseWithEntrance() {
        $rand = rand(1, 2);
        $data = House::factory()->has(Entrance::factory($rand))->create();
        $this->assertCount($rand, $data->entrances);
        $this->assertTrue($data->entrances->first() instanceof Entrance);
    }
}
