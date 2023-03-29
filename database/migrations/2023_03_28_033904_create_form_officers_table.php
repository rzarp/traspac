<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_officers', function (Blueprint $table) {
            $table->id();
            $table->text('nip')->nullable();
            $table->text('nama')->nullable();
            $table->text('tempat_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin',['Laki-Laki','Perempuan']);
            $table->unsignedBigInteger("golongan")->nullable();
            $table->unsignedBigInteger("eselon")->nullable();
            $table->unsignedBigInteger("jabatan")->nullable();
            $table->foreign('golongan')->references('id')->on('officers');
            $table->foreign('eselon')->references('id')->on('officers');
            $table->foreign('jabatan')->references('id')->on('officers');
            $table->text('tempat_tugas')->nullable();
            $table->enum('agama',['Islam','Kristen/Protestan','Katholik','Hindu','Budha','Khong hu chu']);
            $table->text('unit_kerja')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('npwp')->nullable();
            $table->string('foto')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_officers');
    }
}
