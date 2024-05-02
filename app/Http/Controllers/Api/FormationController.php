<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\CreateFormationRequest;
use App\Http\Requests\Formation\UpdateFormationRequest;
use App\Models\Formation;
use Illuminate\Http\Request;
use Exception; 

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $formations = Formation::all();

            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => 'Voici la liste des formations:',
                'data' => $formations
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'status_code' => 500,
                'message' => 'Erreur interne du serveur',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFormationRequest $request)
    {
        try {

            $formation = new Formation ;

            $formation->formation_name = $request->formation_name;
            $formation->formation_type = $request->formation_type;
            $formation->class_format = $request->class_format;
            $formation->accreditation = $request->accreditation;
            $formation->formation_duration = $request->formation_duration;
            $formation->study_level_required = $request->study_level_required;
            $formation->registration_payment = $request->registration_payment;
            $formation->monthly_payment = $request->monthly_payment;
            $formation->school_id = $request->school_id;
            $formation->formation_grade_id = $request->formation_grade_id;
            $formation->sub_domain_id = $request->sub_domain_id;
            
            $formation->save();

            return response()->json([
                'status' => true,
                'status_code' => 201,
                'message' => 'La formation a été créée avec succès.',
                'data' => $formation
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'status_code' => 400,
                'message' => 'Formation non créée',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $formation = Formation::find($id);

            if ($formation === null) {
                return response()->json([
                    'status' => false,
                    'status_code' => 404,
                    'message' => 'Cette formation n\'existe pas',
                ],  404);
            } else {
                return response()->json([
                    'status' => true,
                    'status_code' => 200,
                    'message' => 'Voici la formation : ',
                    'data' => $formation
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "status_code" => 500,
                "message" => "Une erreur est survenue.",
                "error"   => $e->getMessage()
            ],   500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormationRequest $request, string $id)
    {
        try {
            $formation = Formation::find($id);

            $formation->formation_name = $request->formation_name;
            $formation->formation_type = $request->formation_type;
            $formation->class_format = $request->class_format;
            $formation->accreditation = $request->accreditation;
            $formation->formation_duration = $request->formation_duration;
            $formation->study_level_required = $request->study_level_required;
            $formation->registration_payment = $request->registration_payment;
            $formation->monthly_payment = $request->monthly_payment;
            $formation->school_id = $request->school_id;
            $formation->formation_grade_id = $request->formation_grade_id;
            $formation->sub_domain_id = $request->sub_domain_id;

            $formation->update();

            return response()->json([
                'status' => true,
                'statut_code' => 201,
                'message' => 'La formation est modifiée avec succès.',
                'data' => $formation
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'statut_code' => 400,
                'message' => 'Formation non modifiée',
                'error' => $e->getMessage()
            ], 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $formation = Formation::find($id);

                if (!$formation) {

                    return response()->json([
                        'status' => false,
                        'status_code' => 404,
                        'message' => 'Cette formation n\'existe pas',
                    ],   404);
                } else {

                    $formation->delete();
                    
                    return response()->json([
                        'status' => true,
                        'status_code' => 200,
                        'message' => 'Cette formation a été supprimée avec succès',
                    ],    200);
                }
                
        } catch (Exception $e) {

            return response()->json([
                "status" => false,
                "status_code" => 500,
                "message" => "Une erreur est survenue.",
                "error"   => $e->getMessage()
            ],   500);
        }
    }
}
