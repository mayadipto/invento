<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class FileUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => []]);
    }
    public function store(Request $request) {

        if($request->image){
            $data = [];
            for($i=0; $i<count($request->image); $i++) {
                $url = Storage::url($request->image[$i]->store('public'));
                $data[] = array('url' => $url);
            }
            return response()->json([
                'status'=> true,
                'urls'=> $data], 201);
        }
        return response([
            'status' => false,
            'message'=> 'No image found in request'
        ], 406);
    }
    public function delete($id, $table){
//        return response()->json([
//            'id' => $id,
//            'table' => $table
//        ]);
        try{
            $file = DB::table($table)->where('id','=', $id)->get();
            $path = str_replace('storage','public', $file[0]->url);
            Storage::delete($path);
            DB::table($table)->where('id','=', $id)->delete();
            return response()->json([
                    'status'=> true,
                    'message'=> 'File deleted successfully...'
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'status'=> false,
                'message'=> 'Failed to delete file...',
                'error'=> $e
            ], 406);
        }
    }
}
