<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('name');
            $table->string('title');
            $table->text('text');
            $table->integer('category_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
           $table->dropForeign('posts_category_id_foreign');
        });
        Schema::dropIfExists('posts');
    }
}
