<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        //Insert some data
        DB::table('designations')->insert(
            array(
                'title' => 'Project Manager'
            )
        );

        DB::table('designations')->insert(
            array(
                'title' => 'Team Leader'
            )
        );

        DB::table('designations')->insert(
            array(
                'title' => 'Developer'
            )
        );

        DB::table('designations')->insert(
            array(
                'title' => 'Tester'
            )
        );

        DB::table('designations')->insert(
            array(
                'title' => 'Designer'
            )
        );

    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designations');
    }
}
