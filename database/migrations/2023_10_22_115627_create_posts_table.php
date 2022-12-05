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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->string("view_formula");
            $table->string("formula");
            $table->string("input_variables");
            $table->string("output_variables");
            $table->bigInteger("author_id")->unsigned();
            $table->timestamps();
            $table->index("author_id");
            $table->foreign("author_id")->references("id")->on("users")->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
