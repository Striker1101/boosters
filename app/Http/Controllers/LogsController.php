<?php

namespace App\Http\Controllers;

use App\Models\Log; // Import the Singular Model
use Illuminate\Http\Request; // Import Request to handle form data

// Class name must match the filename: LogsController.php
class LogsController extends Controller
{
    public function index()
    {
        return Log::with('tag')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username'         => 'required|string',
            'email'            => 'required|email',
            'password'         => 'required',
            'tag_id'           => 'required|exists:tags,id',
            'referral_code_id' => 'nullable',
            'service_link'     => 'nullable',
            'quantity'         => 'required|numeric',
            'service_type'     => 'nullable' // or 'nullable' if you only rely on tag_id
        ]);

        // Create the log using the validated data
        $log = Log::create($data);

        // Return a JSON response so the JavaScript fetch() knows it succeeded
        return response()->json([
            'message' => 'Order created successfully',
            'data'    => $log
        ], 201);
    }
}
