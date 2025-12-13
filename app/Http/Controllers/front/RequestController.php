<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\RequestCall;
use App\models\Inquiry;
use App\models\Contact;

class RequestController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name1' =>'required|string|max:50',
            'mobile' => 'required|numeric|digits:10', // Example validation rules
        ], [
            'name1.required' => 'Name  is required.',
            'name1.string' => 'Name must be string.',
            'name1.max' => 'Name should only 50 characters.',
            'mobile.required' => 'Mobile number is required.',
            'mobile.numeric' => 'Mobile number must be numeric.',
            'mobile.digits' => 'Mobile number must be 10 digits.',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }
        $mobile = New RequestCall();
        $mobile->mobile = $request->mobile;
        $mobile->name = $request->name1;
        $mobile->save();
        return response()->json(['status' => 'success', 'message' => 'Our executive will call you back soon'], 200);
    }

    public function inquiry_save(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'mobile' => 'numeric|required|digits:10',
            'qty' => 'nullable|integer|min:0',
            'message' => 'required|string|max:1000',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $messages = [

            'name.required' => 'The name field is required.',
            'mobile.numeric' => 'The mobile field must be a number.',
            'mobile.required_without_all' => 'Either email or mobile is required.',
            'mobile.digits' => 'Mobile number must be 10 digits.',
            'qty.integer' => 'The quantity must be an integer.',
            'qty.min' => 'The quantity must be at least :min.',
            'message.max' => 'The message may not be greater than :max characters.',
            'g-recaptcha-response' => [
                'required' => 'Please verify that you are not a robot.',
                'captcha' => 'Captcha error! try again later or contact site admin.',
            ]

        ];

        $validator->setCustomMessages($messages);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $inquiry = new Inquiry();
        $inquiry->product_id = $request->product_id;
        $inquiry->name =$request->name;
        $inquiry->email =$request->email;
        $inquiry->inquiry_from=$request->inquiry_from;
        $inquiry->mobile = $request->mobile;
        $inquiry->qty = $request->qty;
        $inquiry->message=$request->message;
        $inquiry->save();
        // Validation passed, proceed with storing the inquiry

        // For example:
        // Inquiry::create($request->all());

        return response()->json(['status' => 'success', 'message' => 'We will contact you soon'], 200);
    }


    public function contact_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|required_without_all:mobile',
            'mobile' => 'nullable|numeric|digits:10|required_without_all:email',
            'website' => 'nullable|string|min:0|max:70',
            'message' => 'required|string|max:1000',

        ]);

        $messages = [
            'product_id.required' => 'The product ID is required.',
            'product_id.exists' => 'The selected product does not exist.',
            'name.required' => 'The name field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.required_without_all' => 'Either email or mobile is required.',
            'mobile.numeric' => 'The mobile field must be a number.',
            'mobile.required_without_all' => 'Either email or mobile is required.',
            'mobile.digits' => 'Mobile number must be 10 digits.',
            'website.string' => 'The website must be an integer.',
            'website.min' => 'The website must be at least :min.',
            'website.max' => 'The website may not be greater than :max characters.',
            'message.max' => 'The message may not be greater than :max characters.',
            'message.required' => 'The message field is required.',
        ];

        $validator->setCustomMessages($messages);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $inquiry = new Contact();

        $inquiry->name =$request->name;
        $inquiry->email=$request->email;
        $inquiry->mobile = $request->mobile;
        $inquiry->inquiry_from = $request->inquiry_from;
        $inquiry->web_site = $request->website;
        $inquiry->message=$request->message;
        $inquiry->save();
        // Validation passed, proceed with storing the inquiry

        // For example:
        // Inquiry::create($request->all());

        return response()->json(['status' => 'success', 'message' => 'Our executive will call you back soon'], 200);

    }
}
