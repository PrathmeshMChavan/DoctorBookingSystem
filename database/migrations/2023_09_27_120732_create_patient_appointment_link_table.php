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
        Schema::create('patient_appointment_link', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_xid');
            $table->unsignedBigInteger('appointment_xid');
            $table->unsignedBigInteger('department_id');
            $table->enum('status',['cancel','postpone']);
            $table->enum('active', [0, 1])->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patient_xid')->references('id')->on('users');
            $table->foreign('appointment_xid')->references('id')->on('appointments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_appointment_link');
    }
};
