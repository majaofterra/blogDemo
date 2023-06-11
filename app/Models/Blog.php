<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];
    protected $hidden = [
        'id',
        'user_id',
    ];

    protected $appends = ['hash'];
    public function getHashAttribute($id) {
        return Hashids::encode([$this->id,42,$this->id,42]); 
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comments::class);
    }
}
