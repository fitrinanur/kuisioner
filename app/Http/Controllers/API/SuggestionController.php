<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Suggestion;
use App\IconSymbol;

class SuggestionController extends Controller
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
        return Suggestion::with('icon')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $icons = IconSymbol::all();
        return  response()->json(compact('icons'), 200);

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
            'icon_id'   => 'required',
            'sug_desc'   => 'required',
        ]);

        $input['icon_id']      = $request->icon_id['id'];
        $input['title']      = $request->title;
        $input['sug_desc']      = $request->sug_desc;
        $input['external_url']  = $request->external_url;
        $input['active']        = $request->active;
        

        Suggestion::create($input);

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
        $icons = IconSymbol::all();
        $suggestion = Suggestion::where('id',$id)->first();

        return  response()->json(compact('suggestion','icons'), 200);
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


        $suggestion = Suggestion::find($id);
        //
        $this->validate($request,[
            'icon_id'   => 'required',
            'sug_desc'   => 'required',
        ]);

        $suggestion['icon_id']       = $request->icon_id;
        $suggestion['title']         = $request->title;
        $suggestion['sug_desc']      = $request->sug_desc;
        $suggestion['external_url']  = $request->external_url;
        $suggestion['active']        = $request->active;
        

        $suggestion->save();

        return ['message'=>'Successfuly inserted.'];
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
        return Suggestion::destroy($id);
    }
}
