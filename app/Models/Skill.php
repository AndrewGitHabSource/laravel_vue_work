<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];
    protected $fillable = [
        'title'
    ];

    public function resumes(): BelongsToMany {
        return $this->belongsToMany(Resume::class)->withTimestamps()->withPivot('skills_resumes');
    }
}
