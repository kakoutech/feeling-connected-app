<?php

namespace App\Livewire;

use Livewire\Component;

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
        $this->validate([
            'questions.*.question_text' => 'required|string|max:255',
            'questions.*.options.*' => 'required|string|max:255',
            'servay_name'=> 'required|string|max:255',
        ],
        [
            'required' => 'This field is required.',
        ]);

        // foreach ($this->questions as $questionData) {
        //     $question = Question::create([
        //         'question_text' => $questionData['question_text'],
        //     ]);

        //     foreach ($questionData['options'] as $optionText) {
        //         Option::create([
        //             'question_id' => $question->id,
        //             'option_text' => $optionText,
        //         ]);
        //     }
        // }

        // Reset the form

        $this->step++;
        $this->reset(['questions', 'servay_name']);
        
        $this->mount(); // Reinitialize with one empty question

        // Provide feedback
        session()->flash('message', 'Questions and options saved successfully!');
    }


    public function new_servay(){
        $this->step =1;
    }

    public function render()
    {
        return view('livewire.create-questions');
    }
}
