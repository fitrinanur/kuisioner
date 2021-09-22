<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use App\Option;

class OptionController extends Controller
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
        
        return Option::with('question')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $questions = Question::all();
        return  response()->json(compact('questions'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'questionId'        => 'required'
        ];


        if(empty($request->choose_option)){

            $rules['choose_option'] = 'required';

        } else if ($request->choose_option == 'text') {

            $rules['optionName'] = 'required';

        } else if($request->choose_option == 'img'){

            $rules['optionImg'] = 'required';

        }

        $this->validate($request, $rules);





        $input['questionId']      = $request->questionId['id'];
        $input['optionName']      = $request->optionName;
 

        if($request->optionImg){
            $name = time().'.' . explode('/', explode(':', substr($request->optionImg, 0, strpos($request->optionImg, ';')))[1])[1];
            \Image::make($request->optionImg)->save(public_path('public-assets/images/option/').$name);
            $input['optionImg']      = $name;
        }

        $input['isRadius']      = $request->isRadius;
        $input['isCircle']      = $request->isCircle;
        $input['active']      = $request->active;

        Option::create($input);

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
        $questions = Question::all();
        $option = Option::find($id);

        return  response()->json(compact('option','questions'), 200);
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

        // test 

        $rules = [
            'questionId'        => 'required',
        ];

        if(empty($request->choose_option)){

            $rules['choose_option'] = 'required';

        } else if ($request->choose_option == 'text') {

            $rules['optionName'] = 'required';

        } else if($request->choose_option == 'img'){

            $rules['optionImg'] = 'required';

        }

        $this->validate($request, $rules);

        // find option by id
        $option = Option::findOrFail($id);

        if ($request->choose_option == 'text') {

            $currentPhoto = $option->optionImg;
            if($currentPhoto){
                $userPhoto = public_path('public-assets/images/option/').$currentPhoto;
                if(file_exists($userPhoto)){
                    @unlink($userPhoto);
                }
            }

        } else if($request->choose_option == 'img'){

           $request->optionName = null;

           //upload image
            $currentPhoto = $option->optionImg;

            if($request->optionImg != $currentPhoto){
                $name = time().'.' . explode('/', explode(':', substr($request->optionImg, 0, strpos($request->optionImg, ';')))[1])[1];
                \Image::make($request->optionImg)->save(public_path('public-assets/images/option/').$name);

                $option['optionImg']      = $name;
                $userPhoto = public_path('public-assets/images/option/').$currentPhoto;
                if(file_exists($userPhoto)){
                    @unlink($userPhoto);
                }
            }

        }

        $option['questionId']      = $request->questionId;
        $option['optionName']      = $request->optionName;
 

        $option['isRadius']      = $request->isRadius;
        $option['isCircle']      = $request->isCircle;
        $option['active']      = $request->active;

        $option->save();

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
        $option = Option::findOrFail($id);

        
        if($currentPhoto = $option->optionImg){
            $quePhoto = public_path('public-assets/images/option/').$currentPhoto;
            if(file_exists($quePhoto)){
                @unlink($quePhoto);
            }
        }

        $option->delete();
        return ['message' => 'Option Deleted'];

    }
}
