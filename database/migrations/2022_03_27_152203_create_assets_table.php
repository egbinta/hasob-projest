<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('serialNumber');
            $table->text('description');
            $table->string('fixedOrMovable');
            $table->string('picturePath');
            $table->string('purchaseDate');
            $table->string('startUseDate');
            $table->string('purchasePrice');
            $table->string('warantyExpiryDate');
            $table->string('degradationInYears');
            $table->string('currentValueInNaira');
            $table->string('location');
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
        Schema::dropIfExists('assets');
    }
}
