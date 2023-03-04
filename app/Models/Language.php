<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Language extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'title'
    ];

    public function resume(): belongsToMany {
        return $this->belongsToMany(Resume::class);
    }
}
