<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Post::latest()->paginate(16);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $this->validate($request,[
            'title'   => 'required|string|max:191|unique:posts',
            'description'   => 'required',
            'link'   => 'required',
        ]);

        $input['title']      = $request->title;
        $input['description']      = $request->description;
        $input['link']      = $request->link;
        $input['status']      = $request->status;

        Post::create($input);

        return ['message'=>'Successfuly inserted.'];
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
        $post = Post::find($id);
        return  response()->json(compact('post'), 200);
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
        $post = Post::find($id);
        // return $request->all();

        $this->validate($request,[
            'title'   => 'required|string|max:191|unique:posts,title,'.$post->id,
            'description'   => 'required',
            'link'   => 'required',
        ]);

        $post['title']      = $request->title;
        $post['description']      = $request->description;
        $post['link']      = $request->link;
        $post['status']      = $request->status;

        $post->save();

        return ['message' => 'Question Updated Successfully.'];
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
        return Post::destroy($id);
    }
}
