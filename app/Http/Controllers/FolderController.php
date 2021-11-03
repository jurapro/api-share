<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
use App\Http\Requests\UploadRequest;
use App\Http\Resources\FileResource;
use App\Models\Folder;
use App\Models\File;
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
                'user_id' => Auth::id(),
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

    public function uploads(Folder $folder, UploadRequest $request)
    {
        foreach ($request->file('files') as $file) {
            $name = time() . '.' . $file->extension();
            $file->storeAs('uploads', $name);

            $newFile = File::create([
                'user_id' => Auth::id(),
                'name' => $file->getClientOriginalName(),
                'parent_id' => $folder->id,
                'type' => 'file',
            ]);
            $newFile->path()->create([
                'path' => $name
            ]);
            $data[] = $newFile;
        }

        return FileResource::collection($data)->response()->setStatusCode(201);
    }
}
