<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles',function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedMediumInteger('user_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
