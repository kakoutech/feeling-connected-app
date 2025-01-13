<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class QuestionAnswer extends Component
{
    public $questions = [];
    public $answers = [];
    public $submittedAnswers = [];
    public $allValuesArrayFromParent=[];
    public function mount($surveyId, $allValuesArray)
    {
        $this->allValuesArrayFromParent= $allValuesArray;
        $results = DB::table('survey_questions as sq')
            ->join('survey_question_options as sqo', 'sqo.survey_question_id', '=', 'sq.id')
            ->where('sq.survey_id',$surveyId)
            ->select('sq.id', 'sq.question', 'sqo.option')
            ->get();

        $this->questions = $results->groupBy('id')->map(function ($questionGroup) {
            return [
                'id' => $questionGroup->first()->id,
                'text' => $questionGroup->first()->question,
                'options' => $questionGroup->pluck('option')->toArray(),
            ];
        })->values()->toArray();

        // dd( $this->questions);

        // $this->questions = [
        //     [
        //         'id' => 1,
        //         'text' => 'What are your favorite colors?',
        //         'options' => ['Red', 'Blue', 'Green', 'Yellow'],
        //     ],
        // ];

        // Initialize answers array
        foreach ($this->questions as $question) {
            $this->answers[$question['id']] = [];
        }
    }

    public function submitAnswers()
    {
        foreach ($this->questions as $question) {
            $this->submittedAnswers[] = [
               'survey_question_id'   => $question['id'],
               'activity_id'   => $this->allValuesArrayFromParent['activityId'],
               'answer'        => $this->answers[$question['id']][0] ?? null,
               'postal_code' => $this->allValuesArrayFromParent['passcode'],
               'created_at' => $this->allValuesArrayFromParent['date'],
               'updated_at' => now()
            ];
        }
        DB::table('survey_answers')->insert($this->submittedAnswers);
        $this->dispatch('nextStep');

        session()->flash('message', 'Your answers have been submitted!');
    }
    public function render()
    {
        return view('livewire.question-answer');
    }
}
