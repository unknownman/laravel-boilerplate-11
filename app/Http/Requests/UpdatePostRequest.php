<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            //
            "title" => 'required|min:5|max:255',
            'content' => 'required|min:25',
            'slug' => 'required|unique:posts,slug,' . $this->route("post")->id,
        ];
    }

    public function messages()
    {
        return [
            "title.required" => 'لطفا عنوان پست را وارد کنید',
            "content.required" => 'لطفا متن پست را وارد کنید',
            "slug.unique" => 'این نامک قبلا استفاده شده است'
        ];
    }
}
