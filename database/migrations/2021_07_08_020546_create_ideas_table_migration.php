<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTableMigration extends Migration
{
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('position', false, true);
            $table->softDeletes();

            $table->foreign('parent_id')
                ->references('id')
                ->on('ideas')
                ->onDelete('set null');

        });

        Schema::create('idea_closure', function (Blueprint $table) {
            $table->increments('closure_id');

            $table->integer('ancestor', false, true);
            $table->integer('descendant', false, true);
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
