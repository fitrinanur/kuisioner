<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use App\QuestionIndicator;

class QuestionController extends Controller
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
        return Question::latest()->paginate(90);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $indicators = QuestionIndicator::all();
        return  response()->json(compact('indicators'), 200);
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

            'question'   => 'required|string|max:191|unique:questions',
        ]);
        $input['question_indicators_id']    = $request->questionIndicatorId['id'];
        $input['question']     = $request->question;
        

        if($request->photo){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('public-assets/images/question/').$name);
            $input['photo']      = $name;
        }

        Question::create($input);

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
        $question = Question::find($id);

        return  response()->json(compact('question'), 200);
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
        $question = Question::find($id);
        // return $request->all();

        $this->validate($request,[

            'question'   => 'required|string|max:191|unique:questions,question,'.$question->id
        ]);


        $question['question']      = $request->question;
        $currentPhoto = $question->photo;
        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('public-assets/images/question/').$name);
            $question['photo']      = $name;
            $userPhoto = public_path('public-assets/images/question/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        $question->save();

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
        $question = Question::findOrFail($id);

        $currentPhoto = $question->photo;
        if($currentPhoto){
            $userPhoto = public_path('public-assets/images/question/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        $question->delete();
        return ['message' => 'User Deleted'];
    }
}
