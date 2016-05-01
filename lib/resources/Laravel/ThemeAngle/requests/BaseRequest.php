<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class _Model_Request extends Request
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
            _requirements_
        ];
    }
    
    public function attributes(){
        return [
            _attributes_
        ];
    } 
}
