<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        try {
            $user = new User();

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'max:15'],
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->user_id = 2;

            $user->save();

            if ($user) {
                return response()->json([
                    'status' => true,
                    'status_code' => 201,
                    'message' => "Inscription de l'utilisateur reussie",
                    'data' =>  $user,
                ], 201);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Echec de l'inscription de l'utilisateur"
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'statut_code' => 400,
                'message' => 'Une erreur est survenue: ',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        try {

            $credentials = $request->only('email', 'password');
            // dd($credentials);
            if (!($token = auth()->attempt($credentials))) {
                return response()->json([
                    'error' => 'Les informations d\'identification ne sont pas valides.'
                ], 401);
            }

            $user = auth()->user();
            return response()->json([
                'status_code' => 200,
                'status_message' => "Utilisateur connecté avec succès",
                'user' => $user,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 120,
                'token' =>  $token,

                // return $this->respondWithToken($token);
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'statut_code' => 400,
                'message' => 'Une erreur est survenue: ',
                'error' => $e->getMessage()
            ], 400);
        }
    }


    public function logout(Request $request)
    {
        try {
            Auth::logout();
    
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => "Déconnexion réussie",
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'status_code' => 500,
                'message' => 'Une erreur est survenue: ' . $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function profileInfo()
    {
        $user = auth()->user()->only([
            'id', 'name', 'email'
        ]); 
        return response()->json($user);
    }
    


    /**
     * Show the form for editing the specified resource.
     */
    public function updateProfile(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => ['sometimes', 'string', 'max:255'],
                'email' => ['sometimes', 'string', 'email', 'max:255'],
                'password' => ['sometimes', 'string', 'min:8', 'max:15'],
            ]);
    
            $user->name = $request->input('name', $user->name);
            $user->email = $request->input('email', $user->email);
            $user->phone = $request->input('phone', $user->phone);
            $user->adresse = $request->input('adresse', $user->adresse);
    
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
    
            $user->save();
    
            return response()->json([
                'status' => true,
                'status_code' => 201,
                'message' => "Profil utilisateur mis à jour avec succès",
                'data' =>  $user,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'status_code' => 400,
                'message' => 'Une erreur est survenue: ' . $e->getMessage(),
            ], 400);
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function listUsers()
    {
        try {
            $users = User::all();

            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => 'Liste des utilisateurs récupérée avec succès',
                'data' => $users,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'status_code' => 500,
                'message' => 'Une erreur est survenue: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {

            $user = User::find($id);

                if (!$user) {
                    return response()->json([
                        'status' => false,
                        'status_code' => 404,
                        'message' => 'Cet utilisateur n\'existe pas',
                    ],   404);
                } else {
                    $user->delete();
                    return response()->json([
                        'status' => true,
                        'status_code' => 200,
                        'message' => 'Cet utilisateur a été supprimé avec succès',
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
