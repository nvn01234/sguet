<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $cat_ids = Category::pluck('id')->toArray();
        return [
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'body' => 'required|string',
            'tags' => 'array',
            'tags.*' => 'string|required',
            'category_id' => [
                'required',
                Rule::in($cat_ids)
            ],
            'image_url' => 'active_url|nullable|max:255'
        ];
    }
}
