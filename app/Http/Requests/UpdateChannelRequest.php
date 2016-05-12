<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateChannelRequest extends Request
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
            'name' => 'required|unique:channels,name,'.$this->id,
            'homepage' => 'url|unique:channels,homepage,'.$this->id,
        ];
    }
}
