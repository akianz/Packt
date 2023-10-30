<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:250'],
            'author_name' => ['required', 'string', 'max:250'],
            'genre' => ['required', 'string', 'max:250'],
            'description' => ['required', 'string'],
            'isbn' => ['required', 'string', 'max:250'],
            'publisher_name' => ['required', 'string', 'max:250'],
            'image'=>['nullable','image','mimes:jpeg,png,svg','max:2048']
        ];
    }
    public function messages()
    {
        return [
        ];
    }
}
