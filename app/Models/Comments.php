<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'user_id',
        'blog_id',
    ];

   protected $hidden = [
        'id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
