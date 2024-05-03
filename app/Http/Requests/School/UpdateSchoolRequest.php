<?php

namespace App\Http\Requests\School;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateSchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'school_name' => ['string', 'max:255'],
            'phone' =>  ['regex:/^(70|75|76|77|78|33|30)[0-9]{7}$/'],
            'mobile' =>  ['regex:/^(70|75|76|77|78|33|30)[0-9]{7}$/'],
            'email' => [ 'string', 'email', 'max:255', 'unique:schools'],
            'address' => [ 'string', 'max:255'],
            'website' => [ 'string', 'max:255'],
        ];
    }

    
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'error'   => true,
            'message'   => 'Erreur de validation',
            'errorLists'  => $validator->errors()

        ]));
    }


    public function messages(): array
    {
        return [

            'phone.regex' => 'Le "Téléphone" doit être un numéro sénégalais. Il doit commencer par l\'un des préfixes (75, 76, 77, 78, 70, 33, 30) et être suivi de 7 chiffres.',
            
            'mobile.regex' => 'Le "mobile" doit être un numéro sénégalais. Il doit commencer par l\'un des préfixes (75, 76, 77, 78, 70, 33, 30) et être suivi de 7 chiffres.',

            'email.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
            
        ];
    }
}
