<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function index()
    {
        return Folder::all();
    }

    public function create(CreateFolderRequest $request, Folder $folder)
    {
        $folder = Folder::create($request->only(['name', 'parent_id']) + [
                'user_id' => Auth::user()->id,
                'type' => 'folder'
            ]);

        return response()->json([
            'body' => [
                'message' => 'Директория создана',
                'folder_id' => $folder->id
            ]
        ], 201);
    }

    public function show(Folder $folder)
    {
        return $folder->subFolders()->flatten();
    }

    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        $folder->update($request->only(['name', 'parent_id']));
        return [
            'body' => [
                'message' => 'Директория изменена',
            ]
        ];
    }
}
