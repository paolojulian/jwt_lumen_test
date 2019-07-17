<?php

namespace App\Http\Requests\User;
use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;

class CreateRequest extends FormRequest
{
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return false;
        }

        /**
         * Get the validation rules that apply to the request.
        *
        * @return array
        */
        public function rules()
        {
            return [
                'name' => 'required|max:100',
                'username' => 'required|unique:users|max:50',
                'email' => 'required|email|max:255',
                'usertype' => [
                    'required',
                    Rule::in([1, 2, 3])
                ],
                'password' => 'required',
            ];
        }
}
