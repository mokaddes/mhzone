<?php

namespace Modules\ChildCategory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() === 'POST') {
            return [
                'sub_category_id' => "required",
                'name' => "required",
            ];
        } else {
            return [
                'sub_category_id' => "required",
                'name' => "required",
            ];
        }
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sub_category_id.required' => "The Sub category field is required.",
            'name.required' => "The Name field is required.",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
