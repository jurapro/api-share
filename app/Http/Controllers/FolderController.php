<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFolderRequest;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index()
    {
        return Folder::all();
    }

    public function show(Folder $folder)
    {
        return $folder->subFolders()->flatten();
    }

    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        return $folder->inSubFolders($request->parent_id);
    }
}
