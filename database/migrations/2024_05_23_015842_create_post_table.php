<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nck_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('topic_id');
            $table->string('title',1000);
            $table->string('slug',1500);
            $table->longText('detail');
            $table->string('image');
            $table->string('type',10);
            $table->string('metakey');
            $table->string('metakeydesc',1500);
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedTinyInteger('status')->default(2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nck_post');
    }
};