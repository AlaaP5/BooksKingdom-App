<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //'His_university'=>'required|(//unique:authors//)', //note (لعرض رسالة ال validation)
        return [
            'name' => 'required|string',
            'age' => 'required|integer',
            'image' => 'image|mimes:png,jpg',
            'from' => 'required|string',
            'His_university' => 'required|string',
            'description' => 'required|string',
            'About_It' => 'required|string'
        ];
    }
}
