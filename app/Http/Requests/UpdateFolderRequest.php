<?php

namespace App\Http\Requests;

use App\Models\Folder;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFolderRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (Folder::find($this->parent_id)->nameInChildren($value)) {
                        $fail("В целевой директории уже есть объект с таким именем");
                    }
                }
            ],
            'parent_id' => ['required',
                function ($attribute, $value, $fail) {
                    if ($value != 0 && !Folder::find($value)) {
                        $fail("Родительской директории с id: $value не существует");
                    }
                },
                function ($attribute, $value, $fail) {
                    if ($this->route('folder')->inSubFolders($value)) {
                        $fail("Нельзя перенести в эту директорию");
                    }
                },
            ],
        ];
    }
}
