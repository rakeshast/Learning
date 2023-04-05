<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AuthorController extends Controller
{

    public function index(Request $req){
        return view('back.pages.home');
    }
    public function logout(Request $req){
        Auth::guard('web')->logout();
        return redirect('/author/login');
    }

    public function ResetForm(Request $request, $token = null ){
        $data = [
            'pageTitle' => "Reset Password",
        ];
        return view('back.pages.auth.reset', $data)->with(['token'=> $token, 'email'=> $request->email ]);
    }

    // public function crop(Request $request){
    //     $path = 'files/';
    //     if (!File::exists(public_path($path))) {
    //          File::makeDirectory(public_path($path),0777,true);
    //     }
    //     $file = $request->file('file');
    //     $new_image_name = 'UIMG'.date('Ymd').uniqid().'.jpg';
    //     $upload = $file->move(public_path($path), $new_image_name);
    //     if($upload){
    //         return response()->json(['status'=>1, 'msg'=>'Image has been cropped successfully.', 'name'=>$new_image_name]);
    //     }else{
    //           return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
    //     }
    // }

    public function crop(Request $request){
        $path = 'files/';
        if (!File::exists(public_path($path))) {
             File::makeDirectory(public_path($path),0777,true);
        }
        $file = $request->file('file');
        $new_image_name = 'UIMG'.date('Ymd').uniqid().'.jpg';
        $upload = $file->move(public_path($path), $new_image_name);
        if($upload){
            return response()->json(['status'=>1, 'msg'=>'Image has been cropped successfully.', 'name'=>$new_image_name]);
        }else{
              return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
        }
    }


}
