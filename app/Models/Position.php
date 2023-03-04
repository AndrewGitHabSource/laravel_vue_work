<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public function resume(): BelongsToMany {
        return $this->belongsToMany(Resume::class);
    }
}
