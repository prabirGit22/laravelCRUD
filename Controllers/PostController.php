<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class PostController extends Controller
{
    public function create(){
        return view('create');
    }

    public function ourfilestore(Request $request){
        $validted = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
        ]);

        // Upload Image
        $imageName = null;
        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'),$imageName);
        }

        
        
        $post = new Post;
        $post->name = $request->name;
        $post->description = $request->description;
        $post->image = $imageName;
        $post->save();

        return redirect()->route('home')->with('success','Your post has been created!');
    }


    public function editData($id){
        $post = Post :: findOrFail($id);
        return view('edit',['ourPost' => $post]);
    }

    public function updateData($id, Request $request){

        $validted = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
        ]);

        // Update data
        $post = Post :: findOrFail($id);
        $post->name = $request->name;
        $post->description = $request->description;

        // Upload Image
        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'),$imageName);
            $post->image = $imageName;
        }
        
        $post->save();
        return redirect()->route('home')->with('success','Your post has been updated!');
    }


    public function deleteData($id){
        $post = Post :: findOrFail($id);
        $post -> delete();
        return redirect()->route('home')->with('success','Your post has been deleted!');
    }
}
