<?php


namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomLoginController extends Controller
{
    public function loginUser(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $rememberToken = $request->remember;

        $attemp = Auth::guard('web')
            ->attempt([
                'email' => $email,
                'password' => $password
            ], $rememberToken);

        if ($attemp) {
            $msg = [
                'id' => Auth::user()->id,
                'status' => 'success',
                'message' => 'Login successful'
            ];
        } else {
            $msg = [
                'status' => 'error',
                'message' => 'Login fail'
            ];
        }
        return response()->json($msg);
    }
}