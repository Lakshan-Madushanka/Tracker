<?php

declare(strict_types=1);

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('errors', function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Category::class)->constrained();

            $table->string('name');
            $table->text('description');
            $table->string('project_name')->nullable();
            $table->string('project_url')->nullable();
            $table->longText('stack_trace')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('errors');
    }
};
