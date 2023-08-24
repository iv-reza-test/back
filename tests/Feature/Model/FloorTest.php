<?php

namespace Tests\Feature\Model;

use App\Models\Entrance;
use App\Models\Floor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FloorTest extends TestCase {
    use RefreshDatabase;

    public function testStoreData() {

        $data = Floor::factory()->make()->toArray();
        Floor::create($data);

        $this->assertDatabaseHas('floors', $data);
        $this->assertDatabaseCount('floors', 1);

    }

    public function testRelationFloorWithEntrance() {
        $data = Floor::factory()->for(Entrance::factory())->create();
        $this->assertTrue(isset($data->entrance->id));

    }
}
