<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use App\Suggestion;
use App\IconSymbol;
use App\OptionSuggestion;

class OptionSuggestionController extends Controller
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
        return OptionSuggestion::with('icon')->latest()->paginate(16);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $questions = Question::with('option')->get();
        //$suggestions = Suggestion::all();
        $icons = IconSymbol::all();
        return  response()->json(compact('questions','icons'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            //'options_id.*'   => 'required',
            'icon_id'   => 'required',
        ]);


        $input['options_id'] =  json_encode($request->choose_option);
        $input['icon_id'] =  $request->icon_id['id'];

        OptionSuggestion::create($input);

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
        $optionSuggestion = OptionSuggestion::with('icon')->find($id);

        return  response()->json(compact('optionSuggestion'), 200);
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
        $input = OptionSuggestion::find($id);

        $this->validate($request,[
            //'options_id.*'   => 'required',
            'icon_id'   => 'required',
        ]);

        $input['options_id'] =  json_encode($request->choose_option);
        $input['icon_id'] =  $request->icon_id['id'];


        $input->save();

        return ['message' => 'Data Updated Successfully.'];
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
        return OptionSuggestion::destroy($id);
    }
}
