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
        Schema::create('commendes', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('lest_product');
            $table->unsignedBigInteger("in_client");
            $table->unsignedBigInteger("in_user");
            $table->foreign('in_client')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign("in_user")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commendes');
    }
};
