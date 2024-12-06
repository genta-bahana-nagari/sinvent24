<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddCheckConstraintToBarangStok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modifikasi tabel barang
        Schema::table('barang', function (Blueprint $table) {
            // Menambahkan constraint CHECK untuk stok
            $table->integer('stok')->default(0)->change(); // pastikan stok tidak null
            DB::statement('ALTER TABLE barang ADD CONSTRAINT chk_stok_non_negative CHECK (stok >= 0)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Menghapus constraint saat rollback
        DB::statement('ALTER TABLE barang DROP CONSTRAINT chk_stok_non_negative');

        // Jika Anda ingin mengubah kembali tipe kolom stok
        Schema::table('barang', function (Blueprint $table) {
            $table->integer('stok')->default(0)->change(); // pastikan stok tidak null
        });
    }
}
