<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                'email' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'max:15'],
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 2;

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
            // $credentials = $request->only('email', 'password');

            $request->validate([
                "email" => "required|email",
                "password" => "required"
            ]);

            $token = auth()->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ]);
            // Auth Facade
        // $token = Auth::attempt([
        //     "email" => $request->email,
        //     "password" => $request->password
        // ]);
            // dd($token);
            if (!$token) {                
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
            // 'expires_in' => auth()->factory()->getTTL() * 120,
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

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function profileInfo()
    {
        return response()->json(auth()->user());
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function updateProfile(Request $request, User $user)
    {

        // $user = auth()->user();
        // dd($user);
        $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'max:255'],
            'password' => ['sometimes', 'string', 'email', 'min:8', 'max:15'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->adresse = $request->adresse;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
