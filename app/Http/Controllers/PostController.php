<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
        //getPaginateByLimit()はPost.phpで定義したメソッドです。
    }
    
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
       //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }
    
    public function store(Post $post, PostRequest $request)//引数をRequestからPostRequestにする
    {
        $input = $request['post'];
        $input += ['user_id' => $request->user()->id];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input__post = $request['post'];
        $input_post += ['user_id' => $request->user()->id];
        $post->fill($input__post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    //Categoryに対するリレーション
    
    //「1対多」の関係なので単数形に
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }
}
?>