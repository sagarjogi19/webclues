<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    protected $fuel_types;
    protected $colors;

    public function __construct()
    {
        $this->fuel_types = config('cars.fuel_type');
        $this->colors = config('cars.color');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('icon')->nullable();
            $table->enum('color',$this->colors)->comment('1=red,2=black,3=white');
            $table->date('make_date');
            $table->enum('fuel_type',$this->fuel_types)->comment('1=petrol,2=diesel,3=cng');
            $table->text('description');
            $table->text('location')->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('cars');
    }
}
