<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

            $table->uuid('id')->primary();

            $table->string('title');
            $table->string('slug');
            $table->longText('body');
            $table->string('image');

            $table->foreignUuid('category_id')
                ->references('id')
                ->on('categories');

            $table->boolean('published')->default(0);

            $table->foreignUuid('creator_id')
                ->references('id')
                ->on('users');

            $table->dateTime('approve_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
}
