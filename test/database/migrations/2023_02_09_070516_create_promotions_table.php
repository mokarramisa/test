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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->enum('promotion_status', ['active', 'disable']);
            $table->enum('promotion_type', []);
            $table->string('promotion_amount');
            $table->unsignedBigInteger('promotion_total_amount');
            $table->timestamp('starts_at');
            $table->timestamp('finishes_at');
            $table->string('promotion_link');
            $table->foreignId('shop_id')->constrained();
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
        Schema::dropIfExists('promotions');
    }
};
