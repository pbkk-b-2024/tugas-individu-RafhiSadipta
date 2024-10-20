<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_discount_code_to_carts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountCodeToCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('discount_code')->nullable(); // Menambahkan kolom discount_code
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('discount_code'); // Menghapus kolom discount_code
        });
    }
}

