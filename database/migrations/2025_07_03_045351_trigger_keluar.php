<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("


            CREATE TRIGGER trigger_keluar
	    AFTER INSERT ON barang_keluar FOR EACH ROW
 	    begin
  		UPDATE barang
  		SET barang.stok = barang.stok - NEW.qty_keluar
  		WHERE barang.id=NEW.barang_id;
            END;


        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXIST trigger_keluar;");
    }
};
