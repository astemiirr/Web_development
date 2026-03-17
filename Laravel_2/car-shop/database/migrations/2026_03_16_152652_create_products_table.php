<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // название
            $table->text('description'); // описание
            $table->decimal('price', 10, 2); // цена
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // категория
            $table->string('image_url')->nullable(); // ссылка на изображение
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};