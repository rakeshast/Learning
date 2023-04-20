<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('users', ['username','picture', 'biography', 'type', 'blocked', 'direct_publish' ])) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username')->unique();
                $table->string('picture')->nullable();
                $table->text('biography')->nullable();
                $table->integer('type')->default(2);
                $table->integer('blocked')->default(0);
                $table->integer('direct_publish')->default(0); 
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username','picture', 'biography', 'type', 'blocked', 'direct_publish' ]);
        });
    }
}
