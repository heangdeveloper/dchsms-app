<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('dob');
            $table->integer('type_id');
            $table->string('tel');
            $table->date('hire');
            $table->string('stime');
            $table->string('ltime');
            $table->string('email');
            $table->string('national');
            $table->longText('photo');
            $table->enum('employee_type', ['Full Time', 'Part Time']);
            $table->enum('marital_status', ['Married', 'Unmarried']);
            $table->string('village');
            $table->string('commune');
            $table->string('district');
            $table->string('province');
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
        Schema::dropIfExists('employees');
    }
}
