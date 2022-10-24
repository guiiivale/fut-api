<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IsTokenValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {  
        $email = $request->header('email');
        $password = $request->header('password');
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Invalid email'
            ], 401);
        }
        if (!Hash::check($password,$user->password)) {
            return response()->json([
                'message' => 'Invalid password'
            ], 401);
        }
        if ($request->header('Authorization') != 'Basic ' . $user->token) {
            return response()->json([
                'message' => 'Invalid token'
            ], 401);
        }
        return $next($request);
    }
}
