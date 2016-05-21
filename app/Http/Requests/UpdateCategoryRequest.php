<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateCategoryRequest extends Request
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
            //
            'name_en' => 'required|unique:categories,name_en,' .$this->id,
            'name_vi' => 'required|unique:categories,name_vi,' .$this->id,
            'image' => 'required|url'
        ];
    }
}
