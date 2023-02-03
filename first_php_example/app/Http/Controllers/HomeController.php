<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
       public function index() {
        //echo "Welcome to the homepage!";
        return view('Docs');
       }

       //<!-- <a href="{{ route('Docs')}}" class="underline text-gray-900 dark:text-white">Documents</a> -->
}