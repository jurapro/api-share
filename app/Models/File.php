<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Item
{
    use HasFactory;

    protected static $type = 'file';
    protected $table = 'objects';

    public function path()
    {
        return $this->hasOne(Path::class, 'object_id');
    }
}
