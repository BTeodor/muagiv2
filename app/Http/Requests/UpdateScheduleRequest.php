<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateScheduleRequest extends Request
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
            'start_date' => 'date',
            'stream_link' => 'active_url'
        ];
    }
}
