<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateAnswerRequest extends Request
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
            'is_correct' => 'in:0,1',
            'content' => 'required',
            'word_id' => 'exists:words,id',
        ];
    }
}
