<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PosController;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class AdminController extends Controller
{
    //

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }



    public function showProfileData(){
        $id=Auth::user()->id;
        $currentUserData=User::find($id);
        //return view("admin.showProfile",compact('currentUserData'));
        //return redirect()->action([PostController::class, 'index']);
        return redirect()->action('PostController@index');
    }

    public function editProfileData(){
        $currentUserData=User::find(Auth::user()->id);
        return view("admin.editProfile",compact('currentUserData'));
    }
    

    public function updateProfileData (Request $request)  {
            //
            // $request->validate([
            //     'name'      =>  'required',
            //     'mobile'    => 'required',
            //     'email'     =>  'required|email',
            //     'image'     =>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
            // ]);
    
          // $image = $request->hidden_image;
            
            // if($request->image != '')
            // {
            //     $image = time() . '.' . request()->image->getClientOriginalExtension();
    
            //     request()->image->move(public_path('images'), $image);
            // }

            // if ($request->image != '') { 

            //     $file = $request->file('image');

            //     $imageName = date('Y-m-d-H').'_'.$file->getClientOriginalName(); 
            //     $file->move(public_path('profile_images'), $imageName);
            //     $user->image=$imageName;
            //     }
              
            $id = Auth::user()->id;
            $user = User::find($id);

            $user->name = $request->name;

            $user->mobile = $request->mobile;
    
            $user->email = $request->email;
    

                if ($request->file('image')) {

                    $file = $request->file('image');
               
               $filename = date('Y-m-d-H').'_'.$file->getClientOriginalName();
                $file->move(public_path('profile_images'), $filename);
                 //Note this syntax too works.....//$data['image'] = $filename;

                  $user->image = $filename;
               
               }
               
            
           
           // $user->image = $request->image;
    
            $user->save();
    
            //return Redirect::route('admin.showProfile')->with('success', 'user Data has been updated successfully');
        
            return redirect()->route('showProfile')->with('success', 'user Data has been updated successfully');
        }


          


                //   $id = Auth::user()->id;

                //   $data = User::find($id); $data->name = $request->name;

                //   $data->email = $request->email;

                //   $data->mobile = $request->mobile;

                //       if ($request->file('image')) { 
                        
                //         $file = $request->file('image');

                //         $filename = date('Y-m-d-H').'_'.$file->getClientOriginalName(); $file->move(public_path('profile_images'), $filename); 

                //       }

                // $data->save();

                // return redirect()->route('showProfileData');



}



