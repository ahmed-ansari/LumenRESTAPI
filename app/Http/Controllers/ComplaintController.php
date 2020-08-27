<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
use DateTime;


class ComplaintController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function list(Request $request) {

        $userId = $request->input('userId');
        // return [$userId];
        $data['status'] = 'Success';
        // $data['result'] = Complaint::all();
        $data['result'] = Complaint::where('user_id', $userId)
                        ->orderBy('id', 'desc')
                        ->take(10)
                        ->get();
        return response($data, 201)
            ->header('Content-Type','application/json');
    }


    public function create(Request $request)
    {
        $title = $request->input('title');
        $desc = $request->input('desc');
        $category = $request->input('category');

        $image = $request->file('image');
        // $image = $request->input('image');
        // return [$title];

        $state = $request->input('state');
        $district = $request->input('district');
        $area = $request->input('area');

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $latitudeDelta = $request->input('latitudeDelta');
        $longitudeDelta = $request->input('longitudeDelta');

        // echo 'hi';

        // return [$image,$image->getClientOriginalName(), $request->all()];
        $userId = $request->input('userId');
        
        // if(!$request->hasFile('image')) {
            //     return response()->json(['upload_file_not_found'], 400);
            // }
            // $file = $request->file('image');
            // if(!$file->isValid()) {
                //     return response()->json(['invalid_file_upload'], 400);
                // }
                
                // return var_dump($image);
                // return [$image];

        if($image)
        {
            $file = $image->getClientOriginalName();
            $date = new DateTime();
            $filepath = $date->format('YmdHms').'__'.$file;
            $destinationPath = storage_path();
            $status = $request->file('image')->move($destinationPath, $filepath);
        }
        else 
        {
            $filepath = '';
        }

        $data = [
            'title' => $title,
            'category' => $category,
            'desc' => $desc,
            'image_path' => $filepath,
            'user_id' => $userId,
            'state' => $state,
            'district' => $district,
            'area' => $area,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'latitudeDelta' => $latitudeDelta,
            'longitudeDelta' => $longitudeDelta
        ];
        // $data2 = [
        //     'title' => 'first complaint',
        //     'category' => 'low',
        //     'desc' => 'nothing more',
        //     'image_path' => 'test path',
        //     'user_id' => 1,
        //     'state' => 'Telengana',
        //     'district' => 'Hyderabad',
        //     'area' => 'Kothi'
        // ];

        // area: "Guntur 1"
        // category: "low"
        // desc: "Russia’s"
        // district: "Guntur"
        // imagePath: "test path"
        // latitude: 17.385
        // latitudeDelta: 0.0009
        // longitude: 78.4867
        // longitudeDelta: 0.00041564039408866995
        // state: "Andhra Pradesh"
        // title: "from Mobile"
        // userId: 1
        // return  Complaint::create($data)->toSql();
        // return $data;
        // DB::enableQueryLog();


        $complaint = Complaint::create($data);
        // return $complaint;

        // dd(DB::getQueryLog());

        // return DB::getQueryLog();

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
