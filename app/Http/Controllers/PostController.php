<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostUpdate;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }
    public function searchPosts()
    {
        return view('admin.posts.search');
    }
    public function postSearchResult(Request $request)
    {
        $data = Post::where('title','like', '%'.$request->search.'%')->get();
        return response()->json($data, 200);
    }
    public function postsSearchDetails($id)
    {
        $post = Post::find($id);
        $reference = PostUpdate::join('users','users.id','=','post_updates.userID')
                        ->where('post_updates.postID','=', $id)
                        ->select('post_updates.*', 'users.name')
                        ->get();
        return view('admin.posts.post-search-details', compact('post', 'reference'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create($request->all());
        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
       
        $maxNo = PostUpdate::where('postID', '=', $post->id)->max('updateNo')+1;

        $data = $request->all();
        $data['postID'] = $post->id;
        $data['userID'] = Auth::user()->id;
        $data['updateNo'] = $maxNo;

        PostUpdate::create($data);
        return $this->postsSearchDetails($post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
