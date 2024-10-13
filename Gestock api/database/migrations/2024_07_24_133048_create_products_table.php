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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('qaliti');
            $table->string('image')->nullable(); 
            $table->string('price');
            $table->unsignedBigInteger("in_category");
            $table->unsignedBigInteger("in_fournisseur");
            $table->unsignedBigInteger("in_user");
            $table->foreign("in_category")->references("id")->on("categories");
            $table->foreign("in_fournisseur")->references("id")->on("fournissurs");
            $table->foreign("in_user")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
