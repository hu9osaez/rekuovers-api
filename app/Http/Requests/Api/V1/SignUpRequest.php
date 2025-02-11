<?php namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ];
    }
}
