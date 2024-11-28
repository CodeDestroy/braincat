<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::statement($this->dropView());
    }
    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW user_test_try_view AS
                SELECT 
                    user_id,
                    test_id,
                    DATE(created_at) AS test_date,
                    COUNT(*) AS record_count,
                    MAX(passed) AS passed,
                    CASE 
                        WHEN MAX(passed) THEN MIN(id)  -- Если есть passed = true, берем минимальный id
                        ELSE NULL                       -- Иначе NULL
                    END AS test_result_id
                FROM 
                    u2877373_default.test_results
                GROUP BY 
                    user_id, 
                    test_id, 
                    DATE(created_at);
            SQL;
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `user_test_try_view`;
            SQL;
    }
};
