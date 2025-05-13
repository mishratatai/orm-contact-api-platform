<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(Request $request) : JsonResponse
    {
        $contacts = Contact::get();
        if ($contacts->count() > 0) {
            return response()->json(['status' => 'success', 'data' => $contacts], 200);
        } else {
            return response()->json(['status' => 'success', 'data' => 'No data found'], 200);
        }
    }

    public function store(Request $request) : JsonResponse
    {
        
        $contact = Validator::make($request->all() ,[
            'email'                   => 'required|email|max:255',
            'contact_data_source'     => 'required|string|max:255',
            'contact_data_name'       => 'required|string|max:255',
            'contact_data_email'      => 'required|email|max:255',
            'contact_data_phone_no'   => 'required|integer',
            'contact_data_desc'       => 'required|string',
            'ip_address'              => 'nullable|string'
        ]);

        if ($contact->fails()) {
            return response()->json(['status' => 'error', 'message' => $contact->errors()], 422);
        }
        
        try {
            $auth_user = User::where('email', $request->email)->first();
            $contact = new Contact();
            $contact->user_id     = $auth_user->id;
            $contact->data_source = $request->contact_data_source;
            $contact->stage       = 'New';
            $contact->status      = 'Active';
            $contact->name        = $request->contact_data_name;
            $contact->email       = $request->contact_data_email;
            $contact->phone_no    = $request->contact_data_phone_no;
            $contact->desc        = $request->contact_data_desc;
            $contact->ip_address  = $request->ip_address;
            $contact->images      = NULL;
            $contact->save();
            return response()->json(['status' => 'success', 'message' => 'Form successfully submitted'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }
}
