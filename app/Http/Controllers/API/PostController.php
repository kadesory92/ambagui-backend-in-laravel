<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use Illuminate\Http\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return response()->json([
            'posts'=>$posts,
            'status'=>200,
            //'message'=>'Post ajouté avec succès',
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // 1. La validation
            $validations=Validator::make($request->all(), [
                'category_id' => 'bail|required|max:191',
                'title' => 'bail|required|string|max:255',
                "content" => 'bail|required|string|max:255',
                "image" => 'image|mimes:jpeg,jpg,bmp,png|max:2048',
            ]);
            

        // 2. On upload l'image dans "/storage/app/public/posts"
        //$chemin_image = $request->image->store("posts");

        // 3. On enregistre les informations du Post

        if($validations->fails()){
            $errors=$validations->errors();

            return response()->json([
                'errors'=>$errors,
                'status'=>401
            ]);
        }

        if($validations->passes()){
            /* $post=Post::create([
                "title"=>$request->title,
                "image" => $chemin_image,
                "content" => $request->content,
            ]); */

            $post=new Post;

            $post->category_id=$request->input('category_id');
            $post->title=$request->input('title');
            $post->content=$request->input('content');

            if($request->hasFile('image')){
                $file=$request->file('image');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('uploads/post/'.$filename);
                $post->image='uploads/post/'.$filename;
            }

            $post->save();

            return response()->json([
                'status'=>200,
                'message'=>'Post ajouté avec succès',
            ]);

        }

        /* Post::create([
            "title" => $request->title,
            "image" => $chemin_image,
            "content" => $request->content,
        ]); */

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
