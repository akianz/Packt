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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("title",250)->nullable();
            $table->string("author_name",250)->nullable();
            $table->string("genre",250)->nullable();
            $table->text("description")->nullable();
            $table->string("isbn",250)->nullable();
            $table->string("image",250)->nullable();
            $table->date("published")->nullable();
            $table->string("publisher_name",250)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
