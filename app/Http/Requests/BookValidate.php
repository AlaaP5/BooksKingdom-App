<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookValidate extends FormRequest
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
        return [
            'name' => 'required|string',
            'content' =>'required|file',
            'author_id' => 'required|exists:authors,id',
            'type_id' => 'required|exists:types,id',
            'status_id' => 'required|exists:statuses,id',
            'date_publication' => 'required|date',
            'description' => 'required|string',
            'image' => 'required|image|mimes:png,jpg',
            'price'=>'required|integer',
            'pages'=>'required|integer'
        ];
    }
}
