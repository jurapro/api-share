<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory;

    protected $table = 'objects';
    protected static $type = null;

    protected $fillable = [
        'name',
        'parent_id',
        'user_id',
        'type'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('user_id', '=', Auth::id());

            if (!static::$type) {
                return;
            }
            $builder->where('type', '=', static::$type);
        });
    }
}
