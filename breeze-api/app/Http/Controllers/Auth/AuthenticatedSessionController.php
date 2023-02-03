<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use GuzzleHttp\Client;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        
        

        $inputBody= [
            'email' => $request['email'],
            'password' => $request['password'],
            
        ];
       



   


    // $client = new \GuzzleHttp\Client();
    // $url = "http://scoriait.api.com/api/login";
    // //$myBody['name'] = "Demo";
    //     $myBody = $inputBody;
    // $request = $client->post($url,  ['body'=>$myBody]);
    // $response = $request->send();
    
    // dd($response);


        // $client = new Client(['base_uri'=> 'http://scoriait.api.com',[]]);

        // $response = $client->request('POST','api/login');

        // $response = $response->getBody()->getContents();

        // dd(json_decode($response)); 


        //$client = new Client();
// $URI = 'http://scoriait.api.com/api/login';
//         $params['headers'] = ['Content-Type' => 'application/json'];//, 'Authorization' => 'Zoho-authtoken ' . $AuthCode];
// $params['form_params'] = array('email' => $request['email'], 'password' => $request['password']);
// $response = $client->post($URI, $params);

//     $response = Http::post('http://scoriait.api.com/api/login',[
//         'email' => 'donseenu@scoriait.com',
//         'password' => 'test@1234',
//     ]);


// $client = new Client();
// $res = $client->request('GET', 'http://scoriait.api.com/api/Products', [
//     'headers' => [
//       'Accept' => 'application/json',
//       'content-type' => 'application/json',
//       'Authorization'=> 'bearer ' .'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vc2NvcmlhaXQuYXBpLmNvbS9hcGkvbG9naW4iLCJpYXQiOjE2NzQ2Mzk2NTYsImV4cCI6MTY3NDY0MDA3NiwibmJmIjoxNjc0NjM5NjU2LCJqdGkiOiJYVVlBcENKa1BwYnVwWWk0Iiwic3ViIjoxMCwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.JNGqXuCHLGgdjcl8y0JBhhxZadQtcoJ88pZLKWr3InE' 
//     ],
//    // 'json' => $inputBody
//     // [
//     //   'email' => $request["email"],
//     //   'password' => $request["password"]
//     // ]
//   ]);



$client = new Client();
$res = $client->request('POST', 'http://jwttoken.com/api/login', [
    'headers' => [
      'Accept' => 'application/json',
      'content-type' => 'application/json',
      
    ],
   'json' => $inputBody
   //inputBody orrrrrr
    // [
    //   'email' => $request["email"],
    //   'password' => $request["password"]
    // ]
  ]);

  $resultobj = json_decode($res->getBody()->getContents());
        //dd($resultobj);     
  //print_r($resultobj->authorisation->token);
    //   print_r($resultobj->user->name);

       if($resultobj->status == 'success'){
     // dd($resultobj->status);
     //------$request->authenticate();

    //$user=Auth::find($resultobj->user->id);

      $user = User::where('id', $resultobj->user->id)->first();
      //dd($user);
      //-----not Auth::user($user) ;
     //---ww auth()->login($user);

      Auth::login($user);

      //dd(Auth:: user()->name);
        $request->session()->regenerate();
      $request->session()->put('username',$resultobj->user->name);
      
      $request->session()->put('token',$resultobj->authorisation->token);
      
      $request->session()->put('isLoggedIn',true);
      $notification = array(
        'message' => 'User Logged In Successfully', 
        'alert-type' => 'success'
    );
      return redirect()->intended(RouteServiceProvider::HOME)->with($notification);
       }
      



          //  return redirect()->intended(RouteServiceProvider::HOME);
 ///dd($resultobj->authorisation->token);

      //  dd('fghf');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
}