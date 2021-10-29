<?php

namespace App\Http\Requests;

use App\Models\Folder;
use Illuminate\Foundation\Http\FormRequest;

class CreateFolderRequest extends ApiRequest
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
                    if (Folder::where('parent_id', $this->parent_id)->get()->contains('name', $value)) {
                        $fail("There is already an object with the same name in the target directory");
                    }
                }
            ],
            'parent_id' => ['required',
                function ($attribute, $value, $fail) {
                    if ($value != 0 && !Folder::find($value)) {
                        $fail("Parent directory with id: $value does not exist ");
                    }
                },
            ],
        ];
    }
}
