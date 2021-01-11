<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Category;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('fr');
        $posts = Post::latest()->paginate(20);
        foreach($posts as $post){
            $post->setAttribute('user', $post->user);
            $post->setAttribute('category', $post->category);
            $post->setAttribute('added', Carbon::parse($post->created_at)->diffForHumans());
            $post->setAttribute('path', '/posts/'.$post->slug);
        }
        return response()->json($posts);
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
        //
        $name = null;
        if($request->hasFile('image')){
            $name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $name);
        }
        $uuid = Str::uuid()->toString();
        Post::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'text' => $request->text,
            'image' => '/images/'.$name,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'published_by' => $request->user_id,
            'is_published' => $request->is_published
        ]);

        return response()->json(['message' => 'Article ajouté avec succés']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        Carbon::setLocale('fr');
        return response()->json([ 'post' =>[
           'id' => $post->id,
           'title' => $post->title,
           'text' => $post->text,
           'slug' => $post->slug,
           'image' => $post->image,
           'published_by' => $post->user->name,
           'created_at' => $post->created_at->diffForHumans(),
           'user' => $post->user->name,
           'category' => $post->category->title,
           'comments_count' => $post->comments->count(),
           'is_published' => $post->is_published,
           'comment'=> $this->commentsArray($post->comments),
        ]   
        ]);
    }

    public function commentsArray($comments){
        $jsonComments = [];
        foreach($comments as $comment){
            array_push($jsonComments,[
                'id' => $comment->id,
                'text' => $comment->text,
                'created_at' => $comment->created_at->diffForHumans(),
                'user' => $comment->user->name,
            ]);
        }
        return $jsonComments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update( Post $post, Request $request)
    {
        //var_dump($post);
        $name = null;
        $image = $post->image;
        if($request->hasFile('image')){
            $name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $name);
            $image = '/images/' . $name;
        }

        // var_dump($);
      
        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'text' => $request->text,
            'image' => $image,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'published_by' => $request->user_id,
            'is_published' => $request->is_published
        ]);

        return response()->json(['message' => 'Article modifié avec succés']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return response()->json(['message' => 'article supprimé']);
    }

    public function category($slug){
        Carbon::setLocale('fr');
        $categorie = Category::where('slug', $slug)->first();
        $posts = Post::where('category_id', $categorie->id)->get();
        foreach($posts as $post){
            $post->setAttribute('user', $post->user);
            $post->setAttribute('added', Carbon::parse($post->created_at)->diffForHumans());
            $post->setAttribute('path', '/posts/'.$post->slug);
        }
        return response()->json($posts);
    }
}
