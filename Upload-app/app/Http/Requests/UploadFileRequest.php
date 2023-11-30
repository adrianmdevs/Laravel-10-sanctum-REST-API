<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array    */
    public function rules()
    {
        return [
            'filename'=>'required|string',
            'userFile'=>'required|file'
        ];
        //method decides wheather or not to allow a request to go into the application
    }
}
