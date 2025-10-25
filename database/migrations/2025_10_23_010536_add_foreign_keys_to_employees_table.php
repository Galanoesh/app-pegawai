<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            if (!Schema::hasColumn('employees', 'departemen_id')) {
                $table->unsignedBigInteger('departemen_id')->nullable()->after('tanggal_masuk');
            } else {
            }

            if (!Schema::hasColumn('employees', 'jabatan_id')) {
                $table->unsignedBigInteger('jabatan_id')->nullable()->after('departemen_id');
            } else {
            }
        });

        DB::statement("
            UPDATE employees e
            LEFT JOIN departments d ON d.id = e.departemen_id
            SET e.departemen_id = NULL
            WHERE (e.departemen_id = 0) OR (e.departemen_id IS NOT NULL AND d.id IS NULL)
        ");
        DB::statement("
            UPDATE employees e
            LEFT JOIN positions p ON p.id = e.jabatan_id
            SET e.jabatan_id = NULL
            WHERE (e.jabatan_id = 0) OR (e.jabatan_id IS NOT NULL AND p.id IS NULL)
        ");

        $db = DB::getDatabaseName();

        $depFkExists = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', $db)
            ->where('TABLE_NAME', 'employees')
            ->where('COLUMN_NAME', 'departemen_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->exists();

        if (!$depFkExists) {
            Schema::table('employees', function (Blueprint $table) {
                $table->foreign('departemen_id')
                    ->references('id')->on('departments')
                    ->onUpdate('cascade')->onDelete('set null');
            });
        }

        $posFkExists = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', $db)
            ->where('TABLE_NAME', 'employees')
            ->where('COLUMN_NAME', 'jabatan_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->exists();

        if (!$posFkExists) {
            Schema::table('employees', function (Blueprint $table) {
                $table->foreign('jabatan_id')
                    ->references('id')->on('positions')
                    ->onUpdate('cascade')->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        $db = DB::getDatabaseName();

        $depFkExists = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', $db)
            ->where('TABLE_NAME', 'employees')
            ->where('COLUMN_NAME', 'departemen_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->exists();

        if ($depFkExists) {
            Schema::table('employees', function (Blueprint $table) {
                try {
                    $table->dropForeign(['departemen_id']);
                } catch (\Throwable $e) {
                }
            });
        }

        $posFkExists = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', $db)
            ->where('TABLE_NAME', 'employees')
            ->where('COLUMN_NAME', 'jabatan_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->exists();

        if ($posFkExists) {
            Schema::table('employees', function (Blueprint $table) {
                try {
                    $table->dropForeign(['jabatan_id']);
                } catch (\Throwable $e) {
                }
            });
        }
    }
};
