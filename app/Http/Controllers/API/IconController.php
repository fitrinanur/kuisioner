<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\IconSymbol;

class IconController extends Controller
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
       // return IconSymbol::all();
        return IconSymbol::latest()->paginate(10);
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
        $this->validate($request,[
            'title'   => 'required|string|max:191|unique:icon_symbols'
            // 'logic'   => 'required',
        ]);

        $input['title']      = $request->title;

        if($request->photo){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('public-assets/images/icon/').$name);
            $input['photo']      = $name;
        }
        
        IconSymbol::create($input);

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
        $icon = IconSymbol::where('id',$id)->first();

        return  response()->json(compact('icon'), 200);
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
        $icon = IconSymbol::find($id);
        // return $request->all();

        $this->validate($request,[

            'title'   => 'required|string|max:191|unique:icon_symbols,title,'.$icon->id
        ]);


        $icon['title']      = $request->title;

        $currentPhoto = $icon->photo;

        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('public-assets/images/icon/').$name);
            $icon['photo']      = $name;
            $userPhoto = public_path('public-assets/images/icon/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        $icon->save();

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
        $iconSymbol = IconSymbol::findOrFail($id);

        $currentPhoto = $iconSymbol->photo;
        if($currentPhoto){
            $userPhoto = public_path('public-assets/images/icon/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        $iconSymbol->delete();
        return ['message' => 'User Deleted'];
    }
}
