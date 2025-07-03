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
            CREATE FUNCTION function_kategori(kat ENUM('M', 'A', 'BHP', 'BTHP')) RETURNS VARCHAR(50)
            DETERMINISTIC
            BEGIN
                DECLARE kategori VARCHAR(30);

                IF kat = 'M' THEN
                    SET kategori = 'Modal';
                ELSEIF kat = 'A' THEN
                    SET kategori = 'Alat';
                ELSEIF kat = 'BHP' THEN
                    SET kategori = 'Bahan Habis Pakai';
                ELSEIF kat = 'BTHP' THEN
                    SET kategori = 'Bahan Tidak Habis Pakai';
                END IF;

                RETURN kategori;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS function_kategori;");
    }
};
