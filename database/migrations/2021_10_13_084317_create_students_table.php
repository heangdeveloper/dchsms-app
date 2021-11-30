<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('stuno');
            $table->string('sunamekh');
            $table->string('finamekh');
            $table->string('sunameen');
            $table->string('finameen');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('race');
            $table->string('national');
            $table->date('dob');
            $table->string('village');
            $table->string('commune');
            $table->string('district');
            $table->string('province');
            $table->longText('img')->default('default.png');
            $table->string('level');
            $table->string('from_school');
            $table->date('date_admission');
            $table->enum('status', ['Studying', 'Stop', 'Suspension']);
            $table->string('farther_name');
            $table->string('mother_name');
            $table->string('farther_address');
            $table->string('mother_address');
            $table->string('father_job');
            $table->string('mother_job');
            $table->string('father_status');
            $table->string('mother_status');
            $table->string('father_race');
            $table->string('mother_race');
            $table->string('father_national');
            $table->string('mother_national');
            $table->integer('branch_id');
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
        Schema::dropIfExists('students');
    }
}
