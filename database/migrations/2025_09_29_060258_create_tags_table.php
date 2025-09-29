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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag_id');
            $table->foreignId('tweets')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->foreignId('tweet_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('tags', function (Blueprint $table) {
        $table->dropForeign(['tweet_id']);
        $table->dropColumn('tweet_id');
    });


}
};
