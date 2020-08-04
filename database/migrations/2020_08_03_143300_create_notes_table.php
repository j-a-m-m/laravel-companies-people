<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id('noteID')->autoIncrement();
            $table->string('message');
            $table->foreignId('userID', 'fk_notes_users')->constrained('users');
            $table->foreignId('companyID', 'fk_notes_companies')->constrained('companies');
            $table->boolean('isCompanyNote');
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
        Schema::dropIfExists('notes');
    }
}
