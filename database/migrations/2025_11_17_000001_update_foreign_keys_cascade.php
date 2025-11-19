<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropForeign(['petugas_id']);
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
        });

        Schema::table('galery', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::table('foto', function (Blueprint $table) {
            $table->dropForeign(['galery_id']);
            $table->foreign('galery_id')->references('id')->on('galery')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropForeign(['petugas_id']);
            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('petugas_id')->references('id')->on('petugas');
        });

        Schema::table('galery', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts');
        });

        Schema::table('foto', function (Blueprint $table) {
            $table->dropForeign(['galery_id']);
            $table->foreign('galery_id')->references('id')->on('galery');
        });
    }
};