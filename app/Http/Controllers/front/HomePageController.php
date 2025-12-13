<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Blog;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Product;


class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::where('display_in_home','1')->get();
        $products= Product::where('display_in_home','1')->get();
        $blogs= Blog::where('display_in_home','1')->get();
        return view('welcome',compact('services','products','blogs'));
    }
    public function contact(Request $request)
    {
        return view('front.contact');
    }
    public function website1(Request $request)
    {
        $products= Product::where('display_in_home','1')->limit(4)->get();
        return view('website.welcome',compact('products'));
    }
    public function about1(Request $request)
    {

        return view('website.about');
    }
    public function contact1(Request $request)
    {

        return view('website.contact');
    }
    
    public function portfolio(Request $request)
    {

        return view('website.portfolio');
    }

    public function about(Request $request)
    {
        return view('front.about');
    }
    public function courses(Request $request)
    {
        $products = Product::all();
        return view('website.courses',compact('products'));
    }
    public function courses_details(Request $request,$id)
    {
        $product = Product::where('slug',$id)->first();
        return view('website.course_detail',compact('product'));
    }
    public function services(Request $request)
    {
        $services = Service::all();
        return view('front.services',compact('services'));
    }
    public function service_details(Request $request,$id)
    {
        $service = Service::where('slug',$id)->first();
        if($service){

            return view('front.service_details',compact('service'));
        }
        else{
            throw new NotFoundHttpException();
        }
    }

    public function products(Request $request)
    {
        $products= Product::all();
        return view('front.products',compact('products'));
    }
    public function product_details(Request $request,$id)
    {
        $products= Product::all();
        $product = Product::where('slug',$id)->first();
        if($product){
            return view('front.product_details',compact('product','products'));
        }
        else
        {
            throw new NotFoundHttpException();
        }
    }

    public function blogs(Request $request)
    {
        $blogs = Blog::paginate(5);
        return view('front.blogs',compact('blogs'));
    }

    public function blog_details(Request $request,$id)
    {
        $blog = Blog::where('slug',$id)->first();
        if($blog){
            return view('front.blog_details',compact('blog'));

        }        else
        {
            throw new NotFoundHttpException();
        }
    }

    public function search(Request $request)
{
    $searchQuery = $request->input('search_query');
    $cities = Product::where('name', 'LIKE', "$searchQuery%")->limit(5)->get();


    if (count($cities) ) {
        $response = [
            'status' => 200,
            'message' => 'Data Found.',
            'data' => [
                'cities' => $cities->map(function ($city) {
                    $city['type'] = 'city';
                    return $city;
                }),

            ],
        ];

        return response()->json($response, 200);
    } else {
        return response()->json(['status' => 404, 'message' => 'Data not Found'], 404);
    }
}

}
