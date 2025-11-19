<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Services\Upload\UploadManager;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'judul',
        'kategori_id',
        'isi',
        'petugas_id',
        'status',
    ];

    

    


    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function gallery()
    {
        return $this->hasMany(Galery::class, 'post_id')->orderBy('position')->where('status', 1);
    }
    

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
                ->orWhere('isi', 'like', "%{$search}%");
        });
    }

    
    

    


}
