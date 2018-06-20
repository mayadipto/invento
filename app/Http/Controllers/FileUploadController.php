<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class FileUploadController extends Controller
{
    public function store(Request $request) {
//        return $request->image;
        if($request->image){
            $data = [];
            for($i=0; $i<count($request->image); $i++) {
                $data[] = Storage::url($request->image[$i]->store('public'));
            }
            return array(
                'status'=> true,
                'urls'=> $data
            );
        }
        return array(
            'status' => false,
            'message'=> 'No image found in request'
        );
    }
}
