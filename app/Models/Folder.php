<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Folder extends Item
{
    use HasFactory;

    protected static $type = 'folder';
    protected $table = 'objects';


    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function subFolders()
    {
        return $this->children->map(function ($item) {
            $item->subFolders();
            return $item;
        });
    }

    public function inSubFolders($id)
    {
        if ($this->id === $id) {
            return true;
        }

        foreach ($this->children as $item) {
            if ($item->inSubFolders($id)) {
                return true;
            };
        }

        return false;
    }

    public function nameInChildren($name)
    {
        foreach ($this->children as $item) {
            if ($item->name == $name) {
                return true;
            };
        }

        return false;
    }
}
