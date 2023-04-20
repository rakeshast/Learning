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
        if (!Schema::hasColumns('users', ['username','picture', 'biography', 'type', 'blocked', 'direct_publish'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username')->unique()->after('email');
                $table->string('picture')->nullable()->after('username');
                $table->text('biography')->nullable()->after('picture');
                $table->integer('type')->default(2)->after('biography');
                $table->integer('blocked')->default(0)->after('type');
                $table->integer('direct_publish')->default(0)->after('blocked'); 
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
