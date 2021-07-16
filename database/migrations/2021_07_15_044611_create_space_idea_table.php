<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpaceIdeaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_idea', function (Blueprint $table) {
            $table->foreignUuid('space_id')->on('spaces')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('idea_id')->on('ideas')->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['space_id', 'idea_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('space_idea');
    }
}
