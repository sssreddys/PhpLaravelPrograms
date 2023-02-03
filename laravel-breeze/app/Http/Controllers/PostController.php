<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public $posts=null;
    public function __construct(){
        $response=Http:: get('https://jsonplaceholder.typicode.com/posts');
        $this->posts=json_decode($response);
    }
    public function index(){
        $response=Http:: get('https://jsonplaceholder.typicode.com/posts');
        $this->posts=json_decode($response);
        foreach($this->posts as $post){
              //$post->id."-->".$post->title."</br>";
        }
       return view('About',['posts'=>$this->posts]);
    
    }
  public function show($id){
    foreach($this->posts as $post){
        
        if($post->id == $id){
            return view('post',['post'=>$post]);
        }
    
  }
    
  }
   
}
