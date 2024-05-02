<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception; 
use App\Models\SubDomain;

class SubDomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $subDomains = SubDomain::all();

            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => 'Voici la liste des domaine d\'études:',
                'data' => $subDomains
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
                'name' => ['required','string','max:255'],
                'description_domaine' => ['required','string','max:255'],
             ]);
            $subDomain = new SubDomain ;

            $subDomain->name = $request->name;
            $subDomain->description_domaine = $request->description_domaine;
            
            $subDomain->save();
            return response()->json([
                'status' => true,
                'statut_code' => 201,
                'message' => 'La domaine d\'études est créé avec succès.',
                'data' => $subDomain
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'statut_code' => 400,
                'message' => 'Domaine d\'études non créée',
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
            $subDomain = SubDomain::find($id);

            if ($subDomain === null) {
                return response()->json([
                    'status' => false,
                    'status_code' => 404,
                    'message' => 'Cette domaine n\'existe pas',
                ],  404);
            } else {
                return response()->json([
                    'status' => true,
                    'status_code' => 200,
                    'message' => 'Voici la domaine d\'études: ',
                    'data' => $subDomain
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
            $subDomain = SubDomain::find($id);

            $request->validate([
                'name' => ['required','string','max:255'],
                'description_domaine' => ['required','string','max:255'],
             ]);

            $subDomain->name = $request->name;
            $subDomain->description_domaine = $request->description_domaine;
            
            $subDomain->update();

            return response()->json([
                'status' => true,
                'statut_code' => 201,
                'message' => 'La domaine d\'études est modifiée avec succès.',
                'data' => $subDomain
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'statut_code' => 400,
                'message' => 'Domaine d\'études non modifiée',
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
            $subDomain = SubDomain::find($id);

                if (!$subDomain) {

                    return response()->json([
                        'status' => false,
                        'status_code' => 404,
                        'message' => 'Cette domaine d\'études n\'existe pas',
                    ],   404);
                } else {

                    $subDomain->delete();
                    
                    return response()->json([
                        'status' => true,
                        'status_code' => 200,
                        'message' => 'Cette domaine d\'études a été supprimée avec succès',
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