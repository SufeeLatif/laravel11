<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccessManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_access_manages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_role_id')->default('0');
            $table->integer('module_id')->default('0');
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('deleted')->default('0');
            $table->integer('deleted_by')->default('0');
            $table->integer('created_by')->default('0');
            $table->integer('updated_by')->default('0');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_access_manages');
    }
}
