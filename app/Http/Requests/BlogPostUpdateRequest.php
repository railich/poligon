<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false; // Если пользователь имеет авторизацию и не авторизован

        //return auth()->check(); // проверка авторизации

        return true; // мы пока не проверяем авторизацию пользователя
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:200', // обязательный, мин 3, макс 200
            'slug' => 'max:200',
            'excerpt' => 'max:500', // выдержка из статьи
            'content_raw' => 'required|string|min:5|max:10000',
            // значение из blog_category, связка по полю id
            'category_id' => 'required|integer|exists:blog_categories,id',
        ];
    }
}
