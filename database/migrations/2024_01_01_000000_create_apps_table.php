<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('category');
            $table->string('version');
            $table->string('size');
            $table->string('download_url');
            $table->string('icon_url')->nullable();
            $table->float('rating')->default(0);
            $table->integer('download_count')->default(0);
            $table->boolean('is_free')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apps');
    }
};
