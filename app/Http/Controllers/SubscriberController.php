<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use Carbon\Carbon;
use App\Exports\SubscriberPreTestExports;
use App\Exports\SubscriberPostTestExports;

class SubscriberController extends Controller
{
    public function index() {
        $educations = $this->educations();
        $genders = $this->genders();
        $professions = $this->professions();
        $address = $this->address();
        $vaccineStatuses = $this->vaccineStatuses();
    	//$questions = Question::orderBy('id','asc')->get();
    	return view('subscriber',compact('educations','genders','professions','address','vaccineStatuses'));
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $age  = $request->age;
        $gender = $request->gender;
        // $id     = $request->id;
        $date = Carbon::now();
        if($request->telephoneNumber) {
            $data = Subscriber::where('telephoneNumber',$request->telephoneNumber)->first();
            if(!$data) {
                $input['name']   = $request->name;
                $input['gender']  = $request->gender;
                $input['age']  = $request->age;
                $input['education']  = $request->education;
                $input['profession']  = $request->profession;
                $input['telephoneNumber']  = $request->telephoneNumber;
                $input['diseaseHistory']  = $request->diseaseHistory;
                $input['address']  = $request->workingArea;
                $input['isVaccine']  = $request->vaccineStatus;
                Subscriber::create($input);
            }
        }

        //GOES TO POSTER PAGE
        //Got Vaccine [1]
        //Not in Working Area [3]
        //Age not between 18-45  
        if($request->vaccineStatus == '1' || $request->workingArea == '3' || ($request->age > 45 || $request->age < 18) ) {
            return redirect()->route('poster');
        }
        
        //GOES TO INFORMED CONSENT
        return view('informed_consent',compact('name','age','gender','date'));
    }

    public function informedConsent(Request $request)
    {
        // dd($request->all());
        $informedConsent = $request->informedConsent;
        $subs = Subscriber::where('name','=', $request->name)->first();
        $subs->informedConsent = $informedConsent;
        $subs->update();
        
        return redirect()->route('quiz', ['id' => $subs->id, 'type' => 'pre' ]);
    }

    public function educations() {
        return $educations =
        [
            '1' => 'SD/Sederajat',
            '2' => 'SMP/Sederajat',
            '3' => 'SMA/Sederajat',
            '4' => 'Diploma',
            '5' => 'Sarjana',
            '6' => 'S2',
        ];
    }

    public function genders() {
        return $genders =
        [
            'L' => 'Laki-Laki',
            'P' => 'Perempuan',
        ];
    }

    public function address() {
        return $address =
        [
            0 => 'Sangkrah',
            1 => 'Semanggi',
            2 => 'Kedung Lumbu',
            3 => 'Lainnya',
           
        ];
    }

    public function vaccineStatuses() {
        return $vaccineStatuses =
        [
            0 => 'Belum',
            1 => 'Sudah',
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


    public function doExportPre()
    {
        
        return (new SubscriberPreTestExports)->download('SubscriberPreTestExports.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function doExportPost()
    {
        
        return (new SubscriberPostTestExports)->download('SubscriberPostTestExports.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
