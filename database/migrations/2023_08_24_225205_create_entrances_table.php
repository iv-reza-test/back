<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('entrances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_id');
            $table->string('name')->nullable()->comment('set a name for the entrance');
            $table->timestamps();


            $table->foreign('house_id')
                ->references('id')
                ->on('houses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('entrances');
    }
};
