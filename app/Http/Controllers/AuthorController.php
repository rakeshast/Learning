<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Setting;


use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AuthorController extends Controller
{

    public function index(Request $req)
    {
        return view('back.pages.home');
    }

    public function logout(Request $req)
    {
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function ResetForm(Request $request, $token = null)
    {
        $data = [
            'pageTitle' => "Reset Password",
        ];
        return view('back.pages.auth.reset', $data)->with(['token' => $token, 'email' => $request->email]);
    }

    public function crop(Request $request)
    {
        $user = User::find(auth('web')->id());
        $path = 'back/dist/img/authors/';
        $file = $request->file('file');
        $old_picture = $user->getAttributes()['picture'];
        $file_path = $path . $old_picture;

        $new_picture_name = 'UIMG' . $user->id . time() . rand(1, 100000) . '.jpg';

        if ($old_picture != null && File::exists(public_path($file_path))) {
            File::delete(public_path($file_path));
        }

        $upload = $file->move(public_path($path), $new_picture_name);

        if ($upload) {
            $user->update([
                'picture' => $new_picture_name,
            ]);
            return response()->json(['status' => 1, 'msg' => 'Your profile picture has been successfully updated.']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
        }
    }

    public function changeBlogLogo(Request $req)
    {

        $settings = setting::find(1);
        $logo_path = "back/dist/img/logo-favicon";
        $old_logo = $settings->getAttributes()['blog_logo'];
        $file = $req->file('blog_logo');
        $filename = time() . '_' . rand(1, 100000) . '_larablog_logo.png';

        if ($req->hasFile('blog_logo')) {

            if ($old_logo != null && File::exists(public_path($logo_path . $old_logo))) {
                File::delete($logo_path . $old_logo);
            }

            $upload = $file->move(public_path($logo_path), $filename);

            if ($upload) {
                $settings->update([
                    'blog_logo' => $filename
                ]);
                return response()->json(['status' => 1, "msg" => "Logo has been successfully updated."]);
            } else {
                return response()->json(['status' => 0, "msg" => "Something weng wrong"]);
            }
        }
    }

    public function changeBlogFavicon(Request $req)
    {

        $settings = setting::find(1);
        $logo_path = "back/dist/img/logo-favicon";
        $old_logo = $settings->getAttributes()['blog_favicon'];
        $file = $req->file('blog_favicon');
        $filename = time() . '_' . rand(1, 100000) . '_blog_favicon.ico';

        if ($req->hasFile('blog_favicon')) {

            if ($old_logo != null && File::exists(public_path($logo_path . $old_logo))) {
                File::delete($logo_path . $old_logo);
            }

            $upload = $file->move(public_path($logo_path), $filename);

            if ($upload) {
                $settings->update([
                    'blog_favicon' => $filename
                ]);
                return response()->json(['status' => 1, "msg" => "Favicon has been successfully updated."]);
            } else {
                return response()->json(['status' => 0, "msg" => "Something weng wrong"]);
            }
        }
    }

    public function createPost(Request $req)
    {

        $req->validate([
            'post_title' => 'required|unique:posts,post_title',
            'post_content' => 'required',
            'post_category' => 'required|exists:sub_categories,id',
            'featured_image' => 'required|mimes:jpeg,jpg,png|max:1024',
        ]);

        if ($req->hasFile('featured_image')) {
            $path = "images/post_images/";
            $file = $req->file('featured_image');
            $filename = $file->getClientOriginalName();
            $newfilename = time() . '_' . $filename;

            $uploaded = Storage::disk('public')->put($path . $newfilename, (string) file_get_contents($file));
            $post_thumbnails_path = $path . 'thumbnails';

            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }

            //Create square thumbnail
            Image::make(storage_path('app/public/' . $path . $newfilename))
                ->fit(200, 200)
                ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $newfilename));

            //Create Resized Image
            Image::make(storage_path('app/public/' . $path . $newfilename))
                ->fit(500, 350)
                ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $newfilename));


            if ($uploaded) {
                $post = new Post();
                $post->author_id = auth()->id();
                $post->category_id = $req->post_category;
                $post->post_title = $req->post_title;
                // $post->post_slug = Str::slug($req->post_title);
                $post->post_content = $req->post_content;
                $post->post_tags = $req->post_tags;
                $post->featured_image = $newfilename;
                
                $saved = $post->save();
                if ($saved) {
                    return response()->json([
                        'code' => 1,
                        'msg' => "New post has been sucessfully created",
                    ]);
                } else {
                    return response()->json([
                        'code' => 3,
                        'msg' => "Something went wrong in saving post data",
                    ]);
                }
            } else {
                return response()->json([
                    'code' => 3,
                    'msg' => "Something went wrong for uploading featured image.",
                ]);
            }
        }
    }

    public function editPost(Request $request){
        if ( !request()->post_id) {
            return abort(404);
        }else{
            $post = Post::find(request()->post_id);
            $data = [
                'post' => $post,
                'pageTitle' => 'Edit Post'
            ];
            return view('back.pages.edit_post', $data);
        }
    }

    public function updatePost(Request $request){
        if ( $request->hasFile('featured_image') ) {
            
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,'.$request->post_id,
                'post_content' => 'required',
                'post_category' => 'required|exists:sub_categories,id',
                'featured_image' => 'mimes:jpeg,jpg,png|max:1024',
            ]);

            $path = "images/post_images/";
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time().'_'.$filename;

            $uploaded = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));
            $post_thumbnails_path = $path . 'thumbnails';

            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }

            //Create square thumbnail
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(200, 200)
                ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));

            //Create Resized Image
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(500, 350)
                ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));
            
            if ($uploaded) {
                // dd("working");
                $old_post_image = Post::find($request->post_id)->featured_image;

                if ($old_post_image != null && Storage::disk('public')->exists($path.$old_post_image)) {
                    Storage::disk('public')->delete($path.$old_post_image);

                    if (Storage::disk('public')->exists($path.'thumbnails/resized_'.$old_post_image)) {
                        Storage::disk('public')->delete($path.'thumbnails/resized_'.$old_post_image);
                    }
                    if (Storage::disk('public')->exists($path.'thumbnails/thumb_'.$old_post_image)) {
                        Storage::disk('public')->delete($path.'thumbnails/thumb_'.$old_post_image);
                    }  
                                     
                }

                $post = Post::find($request->post_id);
                $post->category_id = $request->post_category;
                $post->post_title = $request->post_title;
                $post->post_slug = null;
                $post->post_content = $request->post_content;
                $post->post_tags = $request->post_tags;
                $post->featured_image = $new_filename;
                $saved = $post->save();

                if ($saved) {
                    return response()->json(['code' => 1, 'msg' => 'Post has been successfully updated.']);
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong for updating post.']);
                }
                
                
            } else {
                return response()->json(['code' => 3, 'msg' => 'Error in uploading new featured image.']);
            }
            

        }else{
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,'.$request->post_id,
                'post_content' => 'required',
                'post_category' => 'required|exists:sub_categories,id'
            ]);

            $post = Post::find($request->post_id);
            $post->category_id = $request->post_category;
            $post->post_slug = null;
            $post->post_content = $request->post_content;
            $post->post_tags = $request->post_tags;
            $post->post_title = $request->post_title;
            $saved = $post->save();

            if ($saved) {
                return response()->json(['code' => 1, 'msg' => 'Posts has been successfully updated.']);
            } else {
                return response()->json(['code' => 3, 'msg' => 'Something went wrong for updating post.']);
            }    
        }
    }


}
