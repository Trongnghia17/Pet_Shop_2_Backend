<?php

use Illuminate\Database\Migrations\Migration; // Sử dụng lớp Migration để định nghĩa một file migration.
use Illuminate\Database\Schema\Blueprint;     // Sử dụng Blueprint để định nghĩa cấu trúc bảng.
use Illuminate\Support\Facades\Schema;       // Sử dụng Schema để thao tác với cơ sở dữ liệu.

return new class extends Migration // Tạo một class ẩn danh kế thừa từ Migration.
{
    /**
     * Run the migrations.
     */
    public function up(): void // Hàm này được chạy khi thực thi migration (php artisan migrate).
    {
        Schema::create('products', function (Blueprint $table) {
            // Tạo bảng 'products' với cấu trúc được định nghĩa bên trong callback function.

            $table->id();
            // Tạo cột 'id' kiểu số nguyên tự tăng, là khóa chính của bảng.

            $table->unsignedBigInteger('category_id');
            // Tạo cột 'category_id' kiểu số nguyên không âm, lưu khóa ngoại liên kết với bảng 'categories'.

            $table->foreign('category_id') // Định nghĩa khóa ngoại cho cột 'category_id'.
            ->references('id')         // Liên kết cột 'category_id' với cột 'id' của bảng 'categories'.
            ->on('categories')         // Chỉ định bảng 'categories' là bảng tham chiếu.
            ->onDelete('cascade');     // Nếu bản ghi trong 'categories' bị xóa, các bản ghi liên quan trong 'products' cũng bị xóa.

            $table->string('slug')->unique();
            // Tạo cột 'slug' kiểu chuỗi, dùng để lưu URL thân thiện của sản phẩm.

            $table->string('name');
            // Tạo cột 'name' kiểu chuỗi, dùng để lưu tên sản phẩm.

            $table->mediumText('description')->nullable();
            // Tạo cột 'description' kiểu văn bản trung bình, có thể để trống (nullable).

            $table->string('brand');
            // Tạo cột 'brand' kiểu chuỗi, dùng để lưu thương hiệu sản phẩm.

            $table->decimal('selling_price', 15, 2);
            // Tạo cột 'selling_price' kiểu chuỗi, dùng để lưu giá bán của sản phẩm.

            $table->decimal('original_price', 15, 2);
            // Tạo cột 'original_price' kiểu chuỗi, dùng để lưu giá gốc của sản phẩm.

            $table->decimal('quantity', 15, 2);
            // Tạo cột 'quantity' kiểu chuỗi, dùng để lưu số lượng sản phẩm.

            $table->string('image')->nullable();
            // Tạo cột 'image' kiểu chuỗi, dùng để lưu đường dẫn hình ảnh sản phẩm, có thể để trống.

            $table->tinyInteger('featured')->default('0')->nullable();
            // Tạo cột 'featured' kiểu số nguyên nhỏ, xác định sản phẩm có được đánh dấu nổi bật hay không.
            // Mặc định là '0' (không nổi bật), có thể để trống.

            $table->tinyInteger('status')->default('0');
            // Tạo cột 'status' kiểu số nguyên nhỏ, lưu trạng thái sản phẩm.
            // Mặc định là '0' (ẩn).

            $table->integer('count')->default('0')->nullable();
            // Tạo cột 'count' kiểu số nguyên, lưu số lượt xem hoặc đếm liên quan đến sản phẩm.
            // Giá trị mặc định là '0', có thể để trống.

            $table->timestamps();
            // Tạo hai cột 'created_at' và 'updated_at', tự động lưu thời gian tạo và cập nhật bản ghi.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // Hàm này chạy khi rollback migration (php artisan migrate:rollback).
    {
        Schema::dropIfExists('products');
        // Xóa bảng 'products' nếu tồn tại.
    }
};
