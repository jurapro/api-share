<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'objects';
    protected static $type = null;

    protected $fillable = [
        'name',
        'parent_id',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('type', function (Builder $builder) {
            if (!static::$type) {
                return;
            }
            $builder->where('type', '=', static::$type);
        });
    }
}
