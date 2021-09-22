<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QuestionIndicator;

class QuestionIndicatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return QuestionIndicator::latest()->paginate(20);
    }

    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'indicator'   => 'required|string|max:191|unique:question_indicators',
        ]);

        $input['indicator']      = $request->indicator;

       
        QuestionIndicator::create($input);

        return ['message'=>'Successfuly inserted.'];
    }

    public function edit($id)
    {
        //
        $questionIndicator = QuestionIndicator::find($id);

        return  response()->json(compact('questionIndicator'), 200);
    }

    public function update(Request $request, $id)
    {
        //
        $questionIndicator = QuestionIndicator::find($id);
       
        $questionIndicator->indicator =  $request->indicator;
        $questionIndicator->save();

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
        $questionIndicator = QuestionIndicator::findOrFail($id);

        $questionIndicator->delete();
        return ['message' => 'Question Indicator Deleted'];
    }
}
