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



class SubscriberPostTestExports implements WithHeadings, FromArray, WithColumnFormatting, ShouldAutoSize
{
    use Exportable;
    private $questions;
    public function __construct() {
        // $this->questions = Question::with('option')->orderBy('id')->get();
        $this->questionIndicator = QuestionIndicator::orderBy('id')->get();
        $this->subscriber_answers = SubscribersAnswers::with('subscribers')->orderBy('id')->get();
    }

    public function map($questions): array
    {
        return [];
    }

    public function array(): array
    {
        $data = [];
       
        foreach ($this->subscriber_answers as $subscriber_answer) {

                // $answers = json_decode($subscriber_answer->post_answer, true);
                $post_score_indicator = json_decode($subscriber_answer->post_score_indicator, true);
            $row = [
                $subscriber_answer->subscribers->name,
                $subscriber_answer->subscribers->gender,
                $subscriber_answer->subscribers->age,
                $subscriber_answer->subscribers->telephoneNumber,
                $subscriber_answer->subscribers->education,
                $subscriber_answer->subscribers->profession,
                $subscriber_answer->subscribers->diseaseHistory,
                Date::dateTimeToExcel($subscriber_answer->created_at),
                $subscriber_answer->post_score
            ];

            // foreach ($this->questions as $question) {
            //     foreach ($question->option as $option) {
            //         if (in_array($option->id, $answers)) {
            //             array_push($row, $option->optionName);
            //         }
            //     }
            // }
            foreach ($this->questionIndicator as $indicator) {
                array_push($row, isset($post_score_indicator['i'. $indicator->id]) ? $post_score_indicator['i'. $indicator->id] : 0  );
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
        $columns = ['Nama Responden', 'Jenis Kelamin', 'Usia', 'Nomor Telepon', 'Pendidikan', 'Pekerjaan', 'Riwayat Penyakit', 'Tanggal Pengisian Kuisioner (Post)','Total Score (Post)'];
        $indicators = [];
        foreach ($this->questionIndicator as $indicator) {
            $indicators[$indicator->id] = $indicator->indicator;
        }

        return array_merge($columns, $indicators);
    }
}