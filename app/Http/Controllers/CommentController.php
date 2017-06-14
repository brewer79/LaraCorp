<?php

namespace Corp\Http\Controllers;

use Corp\Article;
use Corp\Comment;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Validator;
use Auth;
use Response;

class CommentController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $data = $request->except('_token', 'comment_post_ID', 'comment_parent');
        $data['article_id'] = $request->input('comment_post_ID');
        $data['parent_id'] = $request->input(('comment_parent'));

        $validator = Validator::make($data, [
                                            'article_id' => 'integer|required',
                                            'parent_id' => 'integer|required',
                                            'text' => 'string|required'
                                            ]);

        $validator->sometimes(['name', 'email'], 'required|max:255', function($input){

            return !Auth::check();

        });

        if($validator->fails()){
            return Response::json(['error'=>$validator->errors()->all()]);
        }

        $user = Auth::user();
        $comm = new Comment($data);
        if($user){

            $comm->user_id->$user->id;

        }
        $post = Article::find($data['article_id']);
        $post->comment()->save($comm);

        echo json_encode(['hello'=>'world']);

        exit();
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
