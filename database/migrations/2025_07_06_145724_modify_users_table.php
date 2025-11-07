<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Mengubah kolom 'id' menjadi 'int(11)'
        $table->bigIncrements('id')->unsigned()->change(); // Mengubah kolom id jika diperlukan
        
        // Mengganti kolom 'name' menjadi 'username'
        $table->string('username', 255)->unique()->change();

        // Menambahkan kolom 'role' 
        $table->string('role', 50)->nullable();

        // Kolom 'email' dihapus
        $table->dropColumn('email');

        // Mengubah atau memastikan kolom 'password' tetap ada
        $table->string('password', 255)->change();

        // Kolom 'created_at' tetap ada, pastikan sudah ada di tabel
        $table->timestamp('created_at')->nullable()->change();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        // Rollback perubahan yang sudah dibuat
        $table->string('email')->nullable();
        $table->dropColumn('role');
        $table->string('name', 255)->change();
    });
}

};
