<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_by')->nullable();
            $table->integer('role_id');
            $table->string('username');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->string('city')->nullable();;
            $table->integer('state')->nullable();;
            $table->integer('country')->nullable();;
            $table->string('address')->nullable();;             
            $table->date('dob')->nullable();;
            $table->string('gender')->nullable();; 
            $table->string('photo')->nullable();; 
            $table->string('cover_pic')->nullable();; 
            $table->tinyInteger('status')->default(0); 
            $table->tinyInteger('is_email_verified')->default(0); 
            $table->tinyInteger('is_mobile_verified')->default(0); 
            $table->string('utoken')->nullable(); 
            $table->longText('social_urls')->nullable(); 
            $table->integer('country_code')->nullable(); 
            $table->string('age')->nullable(); 
            $table->string('height')->nullable(); 
            $table->string('weight')->nullable(); 
            $table->string('marital_status')->nullable(); 
            $table->string('mother_tongue')->nullable(); 
            $table->string('physical_status')->nullable(); 
            $table->string('complexion')->nullable(); 
            $table->string('profile_created_by')->nullable(); 
            $table->string('eating_habits')->nullable(); 
            $table->string('drinking_habits')->nullable(); 
            $table->string('smoking_habits')->nullable(); 
            $table->string('religion')->nullable(); 
            $table->string('caste')->nullable(); 
            $table->string('sub_caste')->nullable(); 
            $table->string('gothra')->nullable(); 
            $table->string('stzodiacar')->nullable(); 
            $table->string('raasi')->nullable(); 
            $table->string('education_category')->nullable(); 
            $table->string('collage')->nullable(); 
            $table->string('occupation')->nullable(); 
            $table->string('organization')->nullable(); 
            $table->string('employed_in')->nullable(); 
            $table->string('annual_income')->nullable(); 
            $table->string('citizenship')->nullable(); 
            $table->text('family_info')->nullable(); 
            $table->text('hobbies')->nullable(); 
            $table->text('basic_requirements')->nullable(); 
            $table->text('professional_expectations')->nullable(); 
            $table->text('location_pref')->nullable(); 
            $table->text('looking_for')->nullable(); 
            $table->string('talent_type')->nullable(); 
            $table->text('talent_role')->nullable(); 
            $table->string('oauth_uid')->nullable(); 
            $table->string('oauth_firstname')->nullable(); 
            $table->string('oauth_lastname')->nullable(); 
            $table->string('oauth_email')->nullable();  
            $table->string('oauth_photourl')->nullable(); 
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        // Insert some stuff
        DB::table('users')->insert(array(
            'full_name'     => 'Admin',
            'role_id'       => 1,               
            'username'      => 'admin',
            'email'         => 'admin@gmail.com',
            'password'      => '$2y$10$u5EmEr6.fKhIkmeiUvfP/OsP6QwSMyTxNDkTY4RI8Y1jRnT/XXuYe',
        ));

    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
