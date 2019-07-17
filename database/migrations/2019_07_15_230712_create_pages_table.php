<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('url');
            $table->bigInteger('parent_page_id')->unsigned();
            $table->bigInteger('last_updated_by')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        // Foreign Keys somewhat should be a separated function (Laravel Bug)
        Schema::table('pages', function (Blueprint $table) {
            $table->foreign('last_updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('parent_page_id')
                ->references('id')
                ->on('pages')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
