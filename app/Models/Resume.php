<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'info',
        'about',
        'email',
        'last_name',
        'name',
        'avatar',
        'phone',
    ];

    public function position(): BelongsToMany {
        return $this->belongsToMany(Position::class);
    }

    public function portfolios(): hasMany {
        return $this->hasMany(Portfolio::class, 'resume_id');
    }

    public function languages(): belongsToMany {
        return $this->belongsToMany(Language::class);
    }

    public function skills(): BelongsToMany {
        return $this->belongsToMany(Skill::class);
    }
}
