<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMicropostFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('micropost_favorite', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('favorite_id')->unsigned()->index();
            $table->integer('favorited_id')->unsigned()->index();
            $table->timestamps();

            // Foreign key setting
            $table->foreign('favorite_id')->references('id')->on('microposts')->onDelete('cascade');
            $table->foreign('favorited_id')->references('id')->on('microposts')->onDelete('cascade');

            // Do not allow duplication of combination of user_id and follow_id
            $table->unique(['favorite_id', 'favorited_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('micropost_favorite');
    }
}
