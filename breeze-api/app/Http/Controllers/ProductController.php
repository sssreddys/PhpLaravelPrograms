<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }



    public function paginate($items, $perPage = 2, $page = null, $options = []   )
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
       // $x->setCurrentPage(1,'showproducts');
    //     $y = $x->linkCollection();
    //   // dd($y);
    //     return $x;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {

            //------>$Products = json_decode(Products::all()->paginate(3));

            //-------ORM Model approach---> $Products = Products::latest()->paginate(3);

            //------FROM API Call
            $client = new Client();
            $res = $client->request('GET', 'http://jwttoken.com/api/product', [
                'headers' => [
                    'Accept' => 'application/json',
                    'content-type' => 'application/json',
                    'Authorization' => 'bearer ' . session("token")
                ],
                // 'json' => $inputBody
                // [
                //   'email' => $request["email"],
                //   'password' => $request["password"]
                // ]
            ]);
            $result = json_decode($res->getBody()->getContents());
            //dd($result);
            $product = null;
            if ($result->status == "success") {
                $product = $result->product; //->latest()->paginate(3);
            } else {
                return redirect('/login');
            }

            $product = $this->paginate($product, 2, null, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page'
            ]);
            return view('admin.showproducts', compact('product'));
            //->with('i',(request()->input('page',1)-1)*  );

        }
        catch (\GuzzleHttp\Exception\ClientException $e) {
            // This will catch all 400 level errors.
            $notification = array(
                'message' => 'Token Expired! please re-login again',
                'alert-type' => 'success'
            );
            if($e->getResponse()->getStatusCode()== 401)
            {

                return redirect('/logout/1')->with($notification);
                //->with('success','Item created successfully!');
            }
            //return $e->getResponse()->getStatusCode();
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.addproducts');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            //'image' => 'required|string|max:255',
        ]);

        $Product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,

        ]);
        if ($request->file('image')) {

            $file = $request->file('image');

       $filename = date('Y-m-d-H').'_'.$file->getClientOriginalName();
        $file->move(public_path('product_images'), $filename);
         //Note this syntax too works.....//$data['image'] = $filename;

          $Product->image = $filename;

       }

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Products created successfully',
        //     'product' => $Product,
        // ]);
        $Product->save();
        return redirect()->route('SHOWPRODUCTS');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $product = Product::find($id);
        return response()->json([
            'status' => 'success',
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->save();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Products updated successfully',
        //     'product' => $product,
        // ]);
        return redirect()->route('SHOWPRODUCTS');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $Product = Product::find($id);
        $Product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Products deleted successfully',
            'Product' => $Product,
        ]);

    }

    public function addtocart( Request $request ,$id){
       // dd( $request);
        $Product = Product::find($id);
         $users= auth()->user();
         $Carts=new Cart;
        $Carts->title = $Product->title;
      $Carts->quantity=$request->quantity;

        $Carts->image = $Product->image;
        $Carts->description = $Product->description;
        $Carts->name = $users->name;
        $Carts->save();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Products deleted successfully',
        //     'Carts' => $Carts,
        // ]);
        return redirect()->back()->with('message','products Added successfully');

    }



}
