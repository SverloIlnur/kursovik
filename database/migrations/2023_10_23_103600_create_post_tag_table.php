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
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("tag_id")->unsigned();
            $table->bigInteger("post_id")->unsigned();
            $table->timestamps();

            $table->index("tag_id");
            $table->index("post_id");
            $table->foreign("tag_id")->references("id")->on("tags")->onDelete('cascade');
            $table->foreign("post_id")->references("id")->on("posts")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
};
