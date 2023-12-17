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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // varchar(255)
            $table->text('description');
            $table->boolean('status'); // tinyint(1)
            $table->timestamps(); // created_at, updated_at

            // More Datatypes
            // $table->date('date'); // date
            // $table->dateTime('date_time'); // datetime
            // $table->time('time'); // time

            // $table->decimal('amount')->default(0.00);
            // $table->double('double');
            // $table->float('float');
            // $table->integer('integer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
