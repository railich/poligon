<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryUpdateRequest extends FormRequest
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
            'title' => 'required|min:5|max:200', // обязательный, мин 5, макс 200
            'slug' => 'max:200',
            'description' => 'string|max:500|min:3', // строка, макс 500, мин 3
            // обязательный, целый, проверить сущестрование в БД таблице blog_categories, должно быть поле id со значением
            // как у parent_id. Т.е. родитель тоже в этой же таблице.
            'parent_id' => 'required|integer|exists:blog_categories,id',
        ];
    }
}
