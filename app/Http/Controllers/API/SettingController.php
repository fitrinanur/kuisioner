<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings;
use App\Subscriber;
use App\Question;
use App\QuestionIndicator;
use App\Option;

class SettingController extends Controller
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


    //
    public function setting() {
        return Settings::latest()->first();
    }


    //
    public function update(Request $request) {


        $data = Settings::latest()->first();

        $data['main_title']      = $request->main_title;
        $data['sort_desc']      = $request->sort_desc;
        
        $currentPhoto = $data->light_logo;
        if($request->light_logo != $currentPhoto){
            $name = time().'light_logo.' . explode('/', explode(':', substr($request->light_logo, 0, strpos($request->light_logo, ';')))[1])[1];
            \Image::make($request->light_logo)->save(public_path('public-assets/images/').$name);
            $data['light_logo']      = $name;
            $userPhoto = public_path('public-assets/images/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }
        
        $currentPhoto2 = $data->dark_logo;
        if($request->dark_logo != $currentPhoto2){
            $name = time().'dark_logo.' . explode('/', explode(':', substr($request->dark_logo, 0, strpos($request->dark_logo, ';')))[1])[1];
            \Image::make($request->dark_logo)->save(public_path('public-assets/images/').$name);
            $data['dark_logo']      = $name;
            $userPhoto = public_path('public-assets/images/').$currentPhoto2;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }
        
        $currentPhoto3 = $data->favicon;
        if($request->favicon != $currentPhoto3){
            $name = time().'favicon.' . explode('/', explode(':', substr($request->favicon, 0, strpos($request->favicon, ';')))[1])[1];
            \Image::make($request->favicon)->save(public_path('public-assets/images/').$name);
            $data['favicon']      = $name;
            $userPhoto = public_path('public-assets/images/').$currentPhoto3;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        $data['theme_style']        = $request->theme_style;
        $data['site_title']         = $request->site_title;
        $data['footer_text']        = $request->footer_text;

        $data->save();

        return ['message' => 'Setting Updated Successfully.'];
    }



    // 
    public function dashboardData(Request $request) {
        $subscriber = Subscriber::count();
        $question = Question::count();
        $indicator = QuestionIndicator::count();
        $option = Option::count();
        
        return  response()->json(compact('subscriber','question','indicator','option'), 200);
    }

    
}
