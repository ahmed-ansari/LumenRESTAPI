<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
use DateTime;


class ComplaintController extends Controller
{
    public function create(Request $request)
    {
        $title = $request->input('title');
        $desc = $request->input('desc');
        $category = $request->input('category');

        $image = $request->file('image');

        // if(!$request->hasFile('image')) {
        //     return response()->json(['upload_file_not_found'], 400);
        // }
        // $file = $request->file('image');
        // if(!$file->isValid()) {
        //     return response()->json(['invalid_file_upload'], 400);
        // }

        if($image)
        {
            $file = $image->getClientOriginalName();
            $date = new DateTime();
            $filepath = $date->format('YmdHms').'__'.$file;
            $destinationPath = public_path();
            $status = $request->file('image')->move($destinationPath, $filepath);
        }
        else 
        {
            $filepath = '';
        }

        
        $complaint = Complaint::create([
            'title' => $title,
            'category' => $category,
            'desc' => $desc,
            'image_path' => $filepath,
            'user_id' => 1
        ]);

        if($complaint) {
            return response()->json([
                'success' => true,
                'message' => 'Complaint created successfully',
                'data' => $complaint
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Complaint Failed creating',
                'data' => ''
            ], 400);
        }

    }
}
