<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "ticket_name"=>["required"],
            "description"=>["required"],
            "user_id"=>["required","array","exists:users,id"],
        ];
    }

    public function messages(){
        return [
            "ticket_name.required"=>"Le titre est obligatoire",
            "description.required"=>"La description est obligatoire",
            // users
            "user_id.required"=>"Obligatoire",
            "exists"=>"User invalide",

        ];
    }
}
