<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}
protected $fillable = [
    'title',
    'description',
    'category_id',
    'user_id',
    'status',
];
}
