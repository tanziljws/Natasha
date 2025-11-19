<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['judul','type'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'kategori_id');
    }
}
