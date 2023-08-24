<?php

namespace Tests\Feature\Model;

use App\Models\Entrance;
use App\Models\House;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntranceTest extends TestCase {

    use RefreshDatabase;

    public function testStoreData() {

        $data = Entrance::factory()->make()->toArray();
        Entrance::create($data);

        $this->assertDatabaseHas('entrances', $data);
        $this->assertDatabaseCount('entrances', 1);

    }

    public function testRelationEntranceWithHouse() {
        $data = Entrance::factory()->for(House::factory())->create();
        $this->assertTrue(isset($data->house->id));

    }
}
