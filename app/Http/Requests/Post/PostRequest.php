<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        // check if is update or store method
        $required_image = ($this->post) ? 'nullable': 'required';

        return [
            'title'     => 'required|string|min:2|max:255',
            'body'      => 'required|string|min:30',
            'image_'    => "$required_image|mimes:jpg,bmp,png",
            'category'  => ['required', 'string', 'exists:categories,id'],
            'published' => 'required|boolean'
        ];
    }
}
