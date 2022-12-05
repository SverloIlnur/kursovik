<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("post_id")->unsigned();
            $table->bigInteger("rating");
            $table->timestamps();

            $table->index("user_id");
            $table->index("post_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("post_id")->references("id")->on("posts")->onDelete('cascade');

            $table->unique(array('user_id', 'post_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
};