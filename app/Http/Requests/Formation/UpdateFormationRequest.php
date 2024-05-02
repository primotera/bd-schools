<?php

namespace App\Http\Requests\Formation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateFormationRequest extends FormRequest
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
            'formation_name' => 'required|string|max:255',
            'formation_type' => 'required|in:jour,soir,weekend',
            'class_format' => 'required|in:prensentiel,online',
            'accreditation' => 'nullable|string|max:255',
            'formation_duration' => 'required|integer|between:1,5',
            'study_level_required' => 'required|string|max:255',
            'registration_payment' => 'required|integer',
            'monthly_payment' => 'required|integer',
            'school_id' => 'required|exists:schools,id',
            'formation_grade_id' => 'required|exists:formation_grades,id',
            'sub_domain_id' => 'required|exists:sub_domains,id',
        ];
    }
    
    public function messages()
{
    return [

        'formation_name.required' => 'Le nom de la formation est requis.',
        'formation_name.string' => 'Le nom de la formation doit être une chaîne de caractères.',
        'formation_name.max' => 'Le nom de la formation ne doit pas dépasser :max caractères.',
        
        'formation_type.required' => 'Le type de formation est requis.',
        'formation_type.in' => 'Le type de formation doit être parmi :values.',
        
        'class_format.required' => 'Le format de classe est requis.',
        'class_format.in' => 'Le format de classe doit être parmi :values.',
        
        'accreditation.string' => 'L\'accréditation doit être une chaîne de caractères.',
        'accreditation.max' => 'L\'accréditation ne doit pas dépasser :max caractères.',
        
        'formation_duration.required' => 'La durée de la formation est requise.',
        'formation_duration.integer' => 'La durée de la formation doit être un entier.',
        'formation_duration.between' => 'La durée de la formation doit être comprise entre 1 et 5 ans.',

        'study_level_required.required' => 'Le niveau d\'étude requis est requis.',
        'study_level_required.string' => 'Le niveau d\'étude requis doit être une chaîne de caractères.',
        'study_level_required.max' => 'Le niveau d\'étude requis ne doit pas dépasser :max caractères.',
        
        'registration_payment.required' => 'Le paiement d\'inscription est requis.',
        'registration_payment.integer' => 'Le paiement d\'inscription doit être un entier.',
        
        'monthly_payment.required' => 'Le paiement mensuel est requis.',
        'monthly_payment.integer' => 'Le paiement mensuel doit être un entier.',
        
        'school_id.required' => 'L\'ID de l\'école est requis.',
        'school_id.exists' => 'L\'ID de l\'école sélectionnée est invalide.',
        
        'formation_grade_id.required' => 'L\'ID du grade de formation est requis.',
        'formation_grade_id.exists' => 'L\'ID du grade de formation sélectionné est invalide.',
        
        'sub_domain_id.required' => 'L\'ID du sous-domaine est requis.',
        'sub_domain_id.exists' => 'L\'ID du sous-domaine sélectionné est invalide.',
    
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
