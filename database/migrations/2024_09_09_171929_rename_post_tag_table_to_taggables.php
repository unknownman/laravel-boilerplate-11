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
        Schema::rename("post_tag", "taggables");
        Schema::table('taggables', function (Blueprint $table) {
            //
            $table->dropForeign('post_tag_post_id_foreign');
            $table->dropColumn('post_id');
            $table->morphs('taggable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taggables', function (Blueprint $table) {
            //
            $table->dropMorphs('taggable');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
        });
        Schema::rename('taggables', 'post_tag');
    }
};
