<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateEventRequest extends Request
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
            'title' => 'required|unique:event,title,'.$this->id.',id',
            'start_time_string' => 'date',
            'end_time_string' => 'date',
            'event_link' => 'url',
            'image_link' => 'mimes:png,jpg,bmp,jpeg'
        ];
    }
}
