<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    //exampleImageUpload
    public function storeImage(Request $request)
    {

        $image = $request->file('image');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('js/' . $imagename);

        Image::make($image)->fit(1024, 768)->save($location);

        return response('Hello World', 200);
    }
}
