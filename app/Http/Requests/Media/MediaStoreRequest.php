<?php

namespace App\Http\Requests\Media;

use App\media\MimeTypes;
use Illuminate\Foundation\Http\FormRequest;

class MediaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'media.*' => 'required|mimetypes:' . implode(',', MimeTypes::all()) // so the format is valid. eg. mimetypes:images/png,images/jpeg ...
        ];
    }
}
