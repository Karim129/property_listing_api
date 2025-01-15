<?php

use App\Enums\ListingTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('broker_id')->constrained('brokers')->onDelete('cascade');
            $table->string('address')->unique();
            $table->enum('listing_type', [
                ListingTypeEnum::SELL->value,
                ListingTypeEnum::OPEN->value,
                ListingTypeEnum::EXCLUSIVE->value,
                ListingTypeEnum::NET->value,
            ])->default(ListingTypeEnum::OPEN->value);
            $table->string('city');
            $table->string('zip_code')->unique();
            $table->longText('description');
            $table->year('build_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
