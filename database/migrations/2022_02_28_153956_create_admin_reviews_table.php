<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('category_id')->nullable();
            $table->integer('industry_id')->nullable();
            $table->string('title')->nullable();
            $table->string('youtube_url')->nullable();
            $table->timestamp('release_date')->nullable();
            $table->string('director')->nullable();
            $table->string('producers')->nullable();
            $table->string('music_director')->nullable();
            $table->text('starring')->nullable();
            $table->text('story')->nullable();
            $table->string('image')->nullable();
            $table->integer('views')->nullable();
            $table->integer('status')->default(0);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_reviews');
    }
}
