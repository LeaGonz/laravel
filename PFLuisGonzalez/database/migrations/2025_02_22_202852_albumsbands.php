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
        Schema::create("albumsbands", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("photo")->nullable();
            $table->date("release_at")->nullable();
            $table->unsignedBigInteger("band_id");
            $table->foreign("band_id")->references("id")->on("musicbands");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("albumsbands");
    }
};
