<?php

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
   Schema::create('articles', function(Blueprint $table){

$table->id();

$table->foreignId('user_id')
->constrained()
->cascadeOnDelete();

$table->string('title');

$table->longText('content');

$table->enum(
'status',

['draft','published','archived'])->default('draft');

$table->timestamp('published_at')->nullable();
$table->timestamps();
$table->index('status');
$table->index('published_at');

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
