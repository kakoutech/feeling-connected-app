<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Flasher\Toastr\Prime\ToastrInterface;

class CreateQuestions extends Component
{
    public $questions = [];
    public $servay_name;
    public $step =1;

    public function mount()
    {
        $this->questions[] = [
            'question_text' => '',
            'options' => ['', '', '', ''],
        ];
    }

    public function addQuestion()
    {
        $this->questions[] = [
            'question_text' => '',
            'options' => ['', '', '', ''],
        ];
    }

    public function removeQuestion($index)
    {
        unset($this->questions[$index]);
        $this->questions = array_values($this->questions); 
    }

    public function submit()
    {
        $this->validate(
            [
                'questions.*.question_text' => 'required|string|max:255',
                'questions.*.options.*' => 'required|string|max:255',
                'servay_name' => 'required|string|max:255',
            ],
            [
                'required' => 'This field is required.',
            ]
        );

        try {
            DB::beginTransaction();

            $userId = Auth::id();

            $surveyId = DB::table('surveys')->insertGetId([
                'name' => $this->servay_name,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            foreach ($this->questions as $questionData) {
                $questionId = DB::table('survey_questions')->insertGetId([
                    'survey_id' => $surveyId,
                    'question' => $questionData['question_text'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                foreach ($questionData['options'] as $optionText) {
                    DB::table('survey_question_options')->insert([
                        'survey_question_id' => $questionId,
                        'option' => $optionText,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
            DB::commit();

            $this->reset(['questions', 'servay_name']);

            $this->mount();

            toastr()->success('Questions and options saved successfully!.');

            session()->flash('message', 'Questions and options saved successfully!');

            $this->step++;

        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('An error occurred while saving. Please try again.');
            session()->flash('error', 'An error occurred while saving. Please try again.');
        }
    }

    public function new_servay(){
        $this->step =1;
    }

    public function render()
    {
        return view('livewire.create-questions');
    }
}
