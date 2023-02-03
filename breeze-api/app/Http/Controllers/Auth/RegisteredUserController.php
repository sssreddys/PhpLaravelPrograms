<?php

namespace App\Http\Controllers\Auth;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = [
            'name' => $request->name,
            'email' => $request->email,
            // 'mobile' => $request->mobile,
            // 'address' => $request->address,
            'password' =>$request->password, //Hash::make($request->password),
        ];

        $client = new Client();
$res = $client->request('POST', 'http://jwttoken.com/api/register', [
    'headers' => [
      'Accept' => 'application/json',
      'content-type' => 'application/json',
      
    ],
   'json' => $user
  
  ]);

  $resultobj = json_decode($res->getBody()->getContents());
//   dd($resultobj);

        if ($resultobj->status == 'success') {
            $user = User::where('id', $resultobj->user->id)->first();
            Auth::login($user);
            $request->session()->regenerate();
            $request->session()->put('username',$resultobj->user->name);
            
            $request->session()->put('token',$resultobj->authorisation->token);
            
            $request->session()->put('isLoggedIn',true);
            return redirect(RouteServiceProvider::HOME);
        }
       
    }
}