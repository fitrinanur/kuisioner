<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscriber;
use App\SubscribersAnswers;
use Excel;
use App\Exports\SubscriberExports;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class SubscriberController extends Controller
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
    public function index() 
    {
        return Subscriber::latest()->paginate(10);
    }

    public function doExport()
    {
        // $subscriberAnswer = SubscribersAnswers::all()-;
        return (new SubscriberExports)->download('invoices.xlsx', \Maatwebsite\Excel\Excel::XLSX);

        // return Excel::download(new SubscriberExports, 'subs.xlsx');
        // $filename = Carbon::now()->format('Ymdhms').'-Subscribers.xlsx';
        // Excel::store(new SubscriberExports, $filename);
        //     $fullPath = Storage::disk('local')->path($filename);

        //     return response()->json([
        //         'data' => $fullPath,
        //         'message' => 'Subscribers are successfully exported.'
        //     ], 200);
                
    }
// 


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Subscriber::destroy($id);
    }

}
