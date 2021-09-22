<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Question;
use App\IconSymbol;
use App\OptionSuggestion;
use App\Post;
use App\Subscriber;
use App\SubscribersAnswers;
use App\Option;


class QuestionController extends Controller
{
    //
    public function index(Request $request,$id) {
        $educations = $this->educations();
        $genders = $this->genders();
        $professions = $this->professions();
    	$questions = Question::orderBy('id','asc')->limit(26)->get();
        $type = $request->type;
    	return view('question',compact('questions', 'educations','genders','professions', 'id','type'));
    }


    //
    public function answer(Request $request) {
        // define an empty array 
        $options = []; 
        $type =($request->type);
      
        if($data = $request->allOption){
            // type casting of array elemnt
            for($i = 0; $i < count($data); $i++){
                $options[$i] = $data[$i];
            }

            $optionData = DB::table('options')
                            ->selectRaw('question_indicators_id, sum(options.score) as score, (select count(1) from questions where question_indicators_id = qq.question_indicators_id) as total_question')
                            ->join('questions as qq', 'options.questionId','=','qq.id')
                            ->whereIn('options.id',$options)
                            ->groupBy('question_indicators_id')
                            ->get();
            // dd($optionData);
            $score=0;
            $scorePerIndicators = [];
            $subscribersAnswer = SubscribersAnswers::where('subscribers_id', $request->id)->first();

            foreach ($optionData as $optionDt){
                $score_indicator = ($optionDt->score / $optionDt->total_question);
                
                if ($score_indicator == 0){
                    $score += 0;
                    $scorePerIndicators['i' . $optionDt->question_indicators_id] = 0;
                } elseif (($score_indicator > 0.05 && $score_indicator <=0.1) || $optionDt->score  == 1 ) {
                    $score += 1;
                    $scorePerIndicators['i' . $optionDt->question_indicators_id] = 1;
                } elseif ($score_indicator > 0.1 && $score_indicator <= 0.5){
                    $score += 2;
                    $scorePerIndicators['i' . $optionDt->question_indicators_id] = 2;
                } elseif ($score_indicator > 0.5 && $score_indicator < 1){
                    $score += 3;
                    $scorePerIndicators['i' . $optionDt->question_indicators_id] = 3;
                } else {
                    $score += 4;
                    $scorePerIndicators['i' . $optionDt->question_indicators_id] = 4;
                }
            }

            // dd($type);
            if($type == 'pre'){
                if ($subscribersAnswer) {
                    $subscribersAnswer->update([
                        'pre_score' => $score,
                        'pre_answer' => json_encode($options),
                        'pre_score_indicator' => json_encode($scorePerIndicators)
                    ]);
                } else {
                    SubscribersAnswers::create([
                        'subscribers_id' => $request->id,
                        'pre_score' => $score,
                        'pre_answer' => json_encode($options),
                        'pre_score_indicator' => json_encode($scorePerIndicators)
                    ]);
                }   
                if($score >= 14  && $score <=20 || ($score >= 21 && $score <=27 )) {
                        //genap
                    if($score % 2 == 0) {
                        return redirect()->route('poster',[ 'id' => $request->id ,'type' => $type ]);
                    } else {
                        //ganjil ke video
                        return redirect()->route('video',[ 'id' => $request->id ,'type' => $type ]);
                    }
                } else {
                    return redirect()->route('poster');
                }
            } 
            if( $type == 'post') {
                if ($subscribersAnswer) {
                    $subscribersAnswer->update([
                        'post_score' => $score,
                        'post_answer' => json_encode($options),
                        'post_score_indicator' => json_encode($scorePerIndicators)
                    ]);
                } else {
                    SubscribersAnswers::create([
                        'subscribers_id' => $request->id,
                        'post_score' => $score,
                        'post_answer' => json_encode($options),
                        'post_score_indicator' => json_encode($scorePerIndicators)
                    ]);
                } 
                return view('thankyou-page');
            }
        }
        // return redirect(route('quiz'));
    }


        //
    public function getPageDatte($input) {

        $allIcon  = IconSymbol::all();
        $icon = IconSymbol::where('slug',$input)->first();
        // get data
        $result = OptionSuggestion::where('icon_id',$icon->id)->first();

        $post = Post::latest()->first();

        return view('suggestion', compact('result','allIcon','post'));
    }

    public function educations() {
        return $educations =
        [
            '1' => 'SD',
            '2' => 'SMP',
            '3' => 'SMA',
            '4' => 'D3',
            '5' => 'S1',
            '5' => 'S2',
        ];
    }

    public function genders() {
        return $genders =
        [
            'L' => 'Laki-Laki',
            'P' => 'Perempuan',
        ];
    }

    public function professions() {
        return $professions =
        [
            '1' => 'PNS',
            '2' => 'Tenaga Pengajar',
            '3' => 'Wirausaha',
            '4' => 'Wiraswasta',
            '5' => 'Ibu Rumah Tangga',
            '6' => 'Lainnya',
        ];
    }
}
