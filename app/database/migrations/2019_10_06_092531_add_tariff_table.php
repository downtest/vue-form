<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Tariff;

class AddTariffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone')->unique();
            $table->timestamps();
        });

        Schema::create('tariffs', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name', 50);
            $table->float('price', 8, 2);
            $table->string('days');
        });

        Tariff::insert([
            [
                'name'  => 'Basic',
                'price' => '49.99',
                'days'  => '1010100',
            ],
            [
                'name'  => 'Advanced',
                'price' => '149.99',
                'days'  => '1010100',
            ],
            [
                'name'  => 'Full-week',
                'price' => '249.99',
                'days'  => '1111100',
            ],
            [
                'name'  => 'Weekends',
                'price' => '70',
                'days'  => '0000011',
            ]
        ]);

        Schema::create('user_tariff', function (Blueprint $table) {
            $table->bigInteger('user_id')->foreign();
            $table->integer('tariff_id');
            $table->tinyInteger('first_day');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tariffs');
    }
}
