<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTableMigration extends Migration
{
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('space_id')->on('spaces')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->unsignedBigInteger('status');
            $table->boolean('public');
            $table->timestamps();
            $table->foreignUuid('parent_id')->nullable()->on('ideas');
            $table->integer('position', false, true);
            $table->softDeletes();

//            $table->foreign('parent_id')
//                ->references('id')
//                ->on('ideas')
//                ->onDelete('set null');

//            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::create('idea_closure', function (Blueprint $table) {
            $table->increments('closure_id');

            $table->uuid('ancestor');
            $table->uuid('descendant');
            $table->integer('depth', false, true);

            $table->foreign('ancestor')
                ->references('id')
                ->on('ideas')
                ->onDelete('cascade');

            $table->foreign('descendant')
                ->references('id')
                ->on('ideas')
                ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('idea_closure');
        Schema::dropIfExists('ideas');
    }
}
