<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); 
            $table->text('unique_in')->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name'); 
            $table->string('email')->unique(); 
            $table->integer('user_type')->default(1)->nullable();
            $table->string('mobile')->nullable();
            $table->string('image')->default('default-user.jpg');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->tinyInteger('logged_in')->default('0')->comment('1=online,0=offline');
            $table->timestamp('logged_in_at')->nullable();
            $table->timestamp('logged_out_at')->nullable();

            $table->text('location_sign_up')->nullable();
            $table->text('location_sign_in')->nullable();

            $table->longText('about_user')->nullable();

            $table->tinyInteger('theme')->default(0);
            $table->tinyInteger('status')->default('0')->comment('0=deactive,1=active');
            $table->tinyInteger('deleted')->default('0')->comment('0=not deleted,1=deleted');
            $table->integer('deleted_by')->default('0');
            $table->integer('created_by')->default('0');
            $table->integer('updated_by')->default('0');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });



        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
