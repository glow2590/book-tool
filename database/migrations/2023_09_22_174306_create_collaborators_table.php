<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            // foreign key to the user table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // foreign key to the book table
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            // add a role column
            $table->string('role')->default('collaborator');
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
        Schema::dropIfExists('collaborators');
    }
}
