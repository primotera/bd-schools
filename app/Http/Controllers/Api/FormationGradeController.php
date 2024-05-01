<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception; 
use App\Models\FormationGrade;

class FormationGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $formationGrades = FormationGrade::all();

            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => 'Voici la liste des grades de formation:',
                'data' => $formationGrades
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'status_code' => 500,
                'message' => 'Erreur interne du serveur',
                'errors' => $e->getMessage()
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
    public function store(Request $request)
    {
        try {

            $request->validate([
                'formation_grade' => ['required','string','max:255'],
             ]);
            $formationGrade = new FormationGrade;
            $formationGrade->formation_grade = $request->formation_grade;
            $formationGrade->save();
            return response()->json([
                'status' => true,
                'statut_code' => 201,
                'message' => 'La grade de formation est créé avec succès.',
                'data' => $formationGrade
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'statut_code' => 400,
                'message' => 'Grade de formation non créé',
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
            $formationGrade = FormationGrade::find($id);

            if ($formationGrade === null) {
                return response()->json([
                    'status' => false,
                    'status_code' => 404,
                    'message' => 'Cette grade de formationn\'existe pas',
                ],  404);
            } else {
                return response()->json([
                    'status' => true,
                    'status_code' => 200,
                    'message' => 'Voici la grade de formation: ',
                    'data' => $formationGrade
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
    public function update(Request $request, string $id)
    {
        try {
            $formationGrade = FormationGrade::find($id);

            $request->validate([
                'formation_grade' => ['required','string','max:255'],
             ]);

            $formationGrade->formation_grade = $request->formation_grade;

            $formationGrade->save();

            return response()->json([
                'status' => true,
                'statut_code' => 201,
                'message' => 'La grade de formation est modifiée avec succès.',
                'data' => $formationGrade
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'statut_code' => 400,
                'message' => 'Grade de formation est non modifiée',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {

            $formationGrade = FormationGrade::find($id);

                if (!$formationGrade) {
                    return response()->json([
                        'status' => false,
                        'status_code' => 404,
                        'message' => 'Cette grade de formationn\'existe pas',
                    ],   404);
                } else {
                    $formationGrade->delete();
                    return response()->json([
                        'status' => true,
                        'status_code' => 200,
                        'message' => 'Cette grade de formationa été supprimée avec succès',
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
