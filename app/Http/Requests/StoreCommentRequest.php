<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            "name"=>["required"],
            "description"=>["required"],
            "timing"=>["required"],
            "images"=>["required"],
            "images.*"=>["max:1024","mimes:jpej,jpg,png"],
        ];
    }

    public function messages(){
        return [
            "name.required"=>"Le titre est obligatoire",
            "description.required"=>"La Description est obligatoire",
            "timing.required"=>"La duree est obligatoire",
            "images.required"=>"Les images est obligatoire",
            "images.*.max"=>"La taille max est 1MB",
            "images.*.mimes"=>"Les Image doit est a la format jpej,jpg,png",

        ];
    }
}
