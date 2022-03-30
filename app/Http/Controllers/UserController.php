<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Events\LoginHistory;
use Illuminate\Http\Request;
use App\Notifications\UserLoginNotification;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $user = request(['email', 'password']);

        if (! $token = JWTAuth::attempt($user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        return $this->respondWithToken($token);

    }

    // Register the user
    public function register(Request $request) 
    {
        $validator = validator()->make(request()->all(), [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:users',
            'phoneNumber' => 'required',
            'password' => 'required|confirmed|min:6',
            'isDisabled' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ]);
        }

        $user = User::create([
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'pictureUrl' => $request->pictureUrl,
            'password' => bcrypt($request->password),
            'isDisabled' => $request->isDisabled
        ]);

        return response()->json([
            'Message' => 'User created successfully',
            'data' => $user
        ]);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    // Update user 
    public function updateProfile(Request $request, $id){
        $existingUser = User::find($id);
        if($existingUser) {
            $existingUser->firstName = $request->firstName;
            $existingUser->middleName = $request->middleName;
            $existingUser->lastName = $request->lastName;
            $existingUser->email = $request->email;
            $existingUser->phoneNumber = $request->phoneNumber;
            $existingUser->pictureUrl = $request->pictureUrl;
            $existingUser->isDisabled = $request->isDisabled;

            $existingUser->save();

            return response()->json([
                "Message" => "User profile updated successfully",
                "User" => $existingUser
            ]);
        }

        return response()->json([
            "Message" => "No user found"
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl')
        ]);
    }
}
