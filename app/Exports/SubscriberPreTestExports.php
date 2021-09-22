<?php
namespace App\Exports;

use App\Subscribers;
use App\SubscribersAnswers;
use App\Option;
use App\Question;
use App\QuestionIndicator;
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;



class SubscriberPreTestExports implements WithHeadings, FromArray, WithColumnFormatting, ShouldAutoSize
{
    use Exportable;
    private $questionIndicator;
    public function __construct() {
        $this->questionIndicator = QuestionIndicator::orderBy('id')->get();
        // $this->questionIndicator = QuestionIndicator::orderBy('id')->get();
        $this->subscriber_answers = SubscribersAnswers::with('subscribers')->orderBy('id')->get();
    }

    public function array(): array
    {
        $data = [];
       
        foreach ($this->subscriber_answers as $subscriber_answer) {
            $pre_score_indicator = json_decode($subscriber_answer->pre_score_indicator, true);
            // dd($pre_score_indicator);
            $row = [
                $subscriber_answer->subscribers->name,
                $subscriber_answer->subscribers->gender,
                $subscriber_answer->subscribers->age,
                $subscriber_answer->subscribers->telephoneNumber,
                $subscriber_answer->subscribers->education,
                $subscriber_answer->subscribers->profession,
                $subscriber_answer->subscribers->diseaseHistory,
                Date::dateTimeToExcel($subscriber_answer->created_at),
                $subscriber_answer->pre_score
            ];

            foreach ($this->questionIndicator as $indicator) {
                array_push($row, isset($pre_score_indicator['i'. $indicator->id]) ? $pre_score_indicator['i'. $indicator->id] : 0  );
            }

            $data[] = $row;
        }
        
        // dd($data);
        return $data;
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }
    
    public function headings(): array
    {
        $columns = ['Nama Responden', 'Jenis Kelamin', 'Usia', 'Nomor Telepon', 'Pendidikan', 'Pekerjaan', 'Riwayat Penyakit', 'Tanggal Pengisian Kuisioner (Pre)','Total Score (Pre)'];
        $indicators = [];
        foreach ($this->questionIndicator as $indicator) {
            $indicators[$indicator->id] = $indicator->indicator;
        }

        return array_merge($columns, $indicators);
    }
}