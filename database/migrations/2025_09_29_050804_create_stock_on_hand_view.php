<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // hapus view lama kalau ada
        DB::statement('DROP VIEW IF EXISTS stock_on_hand');

        // bikin view baru
        DB::statement(<<<SQL
CREATE VIEW stock_on_hand AS
SELECT
    product_id,
    rack_id,
    SUM(qty) AS qty,
    MAX(updated_at) AS updated_at
FROM (
    -- qty masuk ke rak tujuan
    SELECT
        m.product_id,
        m.rak_tujuan_id AS rack_id,
        m.qty,
        COALESCE(m.updated_at, m.created_at) AS updated_at
    FROM moverak m

    UNION ALL

    -- qty keluar dari rak asal
    SELECT
        m.product_id,
        m.rak_asal_id AS rack_id,
        -m.qty AS qty,
        COALESCE(m.updated_at, m.created_at) AS updated_at
    FROM moverak m
) x
GROUP BY product_id, rack_id
HAVING SUM(qty) <> 0
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS stock_on_hand');
    }
};
