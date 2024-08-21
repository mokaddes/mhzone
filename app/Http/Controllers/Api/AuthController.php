<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Response;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Response
{
    public $authApiGuard;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

        $this->authApiGuard = auth('api');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'password' => 'required|string',
            'username' => 'sometimes|string',
        ]);

        if ($validate->fails()) {
            return $this->sendError('Validation Error', $validate->errors());
        }

        try {
            $login_type = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $credentials = [$login_type => $request->username, 'password' => $request->password];


            if (!$token = $this->authApiGuard->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Crendentials',
                ], 200);
            }

            $token = JWTAuth::fromUser(auth()->guard('api')->user());

            $data = $this->createNewToken($token);


            return parent::sendResponse(200, "Login Successfull", $data);
        } catch (JWTException $e) {
            return parent::sendError('Exception Error', "An error occured, please contact support.");
        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => "required|string|max:100|email|unique:users,email",
            'password' => "required|min:8|max:50",
            'username' => "required|unique:users,username",
        ]);

        if ($validate->fails()) {
            return $this->sendError('Validation Error', $validate->errors());
        }

        try {

            $usernameExists = User::where('username', Str::slug($request->name))->count();

            if ($usernameExists) {
                $username = Str::slug($request->username) . '_' . Str::random(5);
            } else {
                $username = Str::slug($request->username);
            }

            // Create user
            $user = User::create([
                'name' => $request->name,
                'username' => $username,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $token = JWTAuth::fromUser($user);

            $data['message'] = 'User registered';
            $data['user'] = $user;
            $data['access_token'] = $token;

            return parent::sendResponse(200, "User Registerd Successfully", $data);
        } catch (Exception $th) {
            return parent::sendError("Exception Error", "Something wrong");
        }
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->authApiGuard->logout();

        return response()->json(['message' => 'User logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return parent::sendResponse(200, 'resfresh', $this->createNewToken($this->authApiGuard->refresh()));
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authUser()
    {
        $userData = $this->authApiGuard->user();
        $token = JWTAuth::fromUser($userData);

        $data = [
            'access_token' => $token,
            'user' => $userData,
            'token_type' => 'bearer',
            'expires_in' => $this->authApiGuard->factory()->getTTL() * 60 * 24 * 30
        ];



        return parent::sendResponse(200, "User Data", $data);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        $user_data = $this->authApiGuard->user();

        $data = [
            'access_token' => $token,
            'user' => $user_data,
            'token_type' => 'bearer',
            'expires_in' => $this->authApiGuard->factory()->getTTL() * 60 * 24 * 30
        ];

        return $data;
    }
}
