<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id'
    ];

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_tags'); 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
