<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateFormationRequest extends FormRequest
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
            'formation_name' => 'sometimes|string|max:255',
            'formation_type' => 'sometimes|in:jour,soir,weekend',
            'class_format' => 'sometimes|in:prensentiel,online',
            'accreditation' => 'nullable|string|max:255',
            'formation_duration' => 'sometimes|integer|between:1,5',
            'study_level_required' => 'sometimes|string|max:255',
            'registration_payment' => 'sometimes|integer',
            'monthly_payment' => 'sometimes|integer',
            'school_id' => 'sometimes|exists:schools,id',
            'formation_grade_id' => 'sometimes|exists:formation_grades,id',
            'sub_domain_id' => 'sometimes|exists:sub_domains,id',
        ];
    }
    
    public function messages()
{
    return [

        'formation_name.string' => 'Le nom de la formation doit être une chaîne de caractères.',
        'formation_name.max' => 'Le nom de la formation ne doit pas dépasser :max caractères.',
        
        'formation_type.in' => 'Le type de formation doit être parmi :values.',
        
        'class_format.in' => 'Le format de classe doit être parmi :values.',
        
        'accreditation.string' => 'L\'accréditation doit être une chaîne de caractères.',
        'accreditation.max' => 'L\'accréditation ne doit pas dépasser :max caractères.',
        
        'formation_duration.integer' => 'La durée de la formation doit être un entier.',
        'formation_duration.between' => 'La durée de la formation doit être comprise entre 1 et 5 ans.',

        'study_level_required.string' => 'Le niveau d\'étude requis doit être une chaîne de caractères.',
        'study_level_required.max' => 'Le niveau d\'étude requis ne doit pas dépasser :max caractères.',
        
        'registration_payment.integer' => 'Le paiement d\'inscription doit être un entier.',
        
        'monthly_payment.integer' => 'Le paiement mensuel doit être un entier.',
        
        // 'school_id.exists' => 'L\'ID de l\'école sélectionnée est invalide.',
        
        // 'formation_grade_id.exists' => 'L\'ID du grade de formation sélectionné est invalide.',
        
        // 'sub_domain_id.exists' => 'L\'ID du sous-domaine sélectionné est invalide.',
    
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


}
