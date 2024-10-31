<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8",
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    "message" => "Validation failed",
                    "errors" => $validator->errors(),
                ],
                422
            );
        }

        try {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);

            // Assign the user role
            $user->assignRole("user"); // or 'admin' if you want to make them admin

            $token = $user->createToken("auth_token")->plainTextToken;

            return response()->json(
                [
                    "message" => "Registration successful",
                    "user" => $user,
                    "token" => $token,
                ],
                201
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "message" => "Registration failed",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                "email" => "required|email|exists:users",
                "password" => "required",
            ]);

            $user = User::where("email", $data["email"])->first();

            if (!$user || !Hash::check($data["password"], $user->password)) {
                return response()->json(
                    [
                        "message" => "Invalid credentials",
                    ],
                    401
                );
            }

            $token = $user->createToken("auth_token")->plainTextToken;

            return response()->json(
                [
                    "user" => $user,
                    "token" => $token,
                    "role" => $user->getAllPermissions(),
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "message" => "Login failed",
                    "error" => $e->getMessage(),
                ],
                400
            );
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json(
                [
                    "message" => "Successfully logged out",
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "message" => "Logout failed",
                    "error" => $e->getMessage(),
                ],
                400
            );
        }
    }
}
