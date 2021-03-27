<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('has_separate_owner')->default(false);
            $table->string('owner_name')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('owner_phone')->nullable();
            $table->string('company_name');
            $table->string('company_org_nr');
            $table->string('company_address');
            $table->string('company_postcode');
            $table->string('company_city');
            $table->enum('role', ['new', 'grower'])->default('new');
            $table->boolean('has_previously_grown_for_foodhills')->default(false);
            $table->boolean('organic_farming')->default(false);
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
        Schema::dropIfExists('customers');
    }
}
