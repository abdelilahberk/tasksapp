<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'name' => ["required"],
            'task_type_id' => ["required", "exists:task_types,id"],
            'task_status_id' => ["required", "exists:task_statuses,id"],
            'description' => ["required"],

        ];
    }
    public function messages()
    {
        return [
            // name
            'name.required' => 'Titre est obligatoire',

            // type
            'task_type_id.required'  => 'Le type  est obligatoire',
            'task_type_id.exists'  => 'Le type N\'exists pas',
            
            // stasus
            'task_status_id.required'  => 'Le status  est obligatoire',
            'task_status_id.exists'  => 'Le status N\'exists pas',

            // description
            'description'  => 'La description est obligatoire',


        ];
    }
}
