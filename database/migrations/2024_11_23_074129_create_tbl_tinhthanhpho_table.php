<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tbl_tinhthanhpho', function (Blueprint $table) {
        $table->increments('matp'); // Khóa chính tự tăng
        $table->string('name'); // Tên tỉnh/thành phố
        $table->string('type')->nullable(); // Loại (thành phố/tỉnh)
        $table->timestamps(); // Tự động thêm cột created_at và updated_at
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tinhthanhpho');
    }
};
