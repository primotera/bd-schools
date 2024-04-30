<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            
            $user = $request->user();            
            // dd($user);
            if ($user->role_id != 1) {
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => 'Voici la liste de rôles:',
                'data' => Role::all()
            ], 200);
        }
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
    public function create(Request $request)
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
                'description' => ['required','string','max:255'],
            ]);
            $role = new Role;
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();
            return response()->json([
                'status' => true,
                'statut_code' => 201,
                'message' => 'Rôle créé avec succès.',
                'data' => $role
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'statut_code' => 400,
                'message' => 'Rôle non créé',
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
            $role = Role::find($id);
            if ($role === null) {
                return response()->json([
                    'status' => false,
                    'status_code' => 404,
                    'message' => 'Ce role n\'existe pas',
                ],  404);
            } else {
                return response()->json([
                    'status' => true,
                    'status_code' => 200,
                    'message' => 'Voici le rôle: ',
                    'data' => $role
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
    public function update(Request $request, $id)
    {

        try {
            $role = Role::find($id);
                // dd($role);
                if ($role === null) {
                    return response()->json([
                        "status" => false,
                        "status_code" => 404,
                        "message" => "Ce role n'existe pas.",
                    ],    404);
                } else {

                    $request->validate([
                        'name' => ['required','string','max:255'],
                        'description' => ['required','string','max:255'],
                    ]);
                    $role->name = $request->name;
                    $role->description = $request->description;

                    $role->update();

                    return response()->json([
                        'status' => true,
                        'status_code' => 200,
                        'message' => 'Le nom du role a été modifié avec succès',
                        'role' => $role,
                    ],  200);
                }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "status_code" => 500,
                "message" => "Une erreur est survenue.",
                "error"   => $e->getMessage()
            ],  500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
         $role = Role::find($id);

        try {
                if (!$role) {
                    return response()->json([
                        'status' => false,
                        'status_code' => 404,
                        'message' => 'Ce role n\'existe pas',
                    ],   404);
                } else {
                    $role->delete();
                    return response()->json([
                        'status' => true,
                        'status_code' => 200,
                        'message' => 'Ce role a été supprimé avec succès',
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
