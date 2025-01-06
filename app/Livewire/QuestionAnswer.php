<?php

namespace App\Livewire;

use Livewire\Component;

class QuestionAnswer extends Component
{
    public $questions = [];
    public $answers = []; 
    public $submittedAnswers = [];
    public function mount()
    {
        $this->questions = [
            [
                'id' => 1,
                'text' => 'What are your favorite colors?',
                'options' => ['Red', 'Blue', 'Green', 'Yellow'],
            ],
            [
                'id' => 2,
                'text' => 'Which programming languages do you know?',
                'options' => ['PHP', 'JavaScript', 'Python', 'Ruby'],
            ],
            [
                'id' => 3,
                'text' => 'What are your preferred modes of transportation?',
                'options' => ['Car', 'Bicycle', 'Bus', 'Train'],
            ],
            [
                'id' => 4,
                'text' => 'What are your favorite cuisines?',
                'options' => ['Italian', 'Chinese', 'Indian', 'Mexican'],
            ],
            [
                'id' => 5,
                'text' => 'What are your hobbies?',
                'options' => ['Reading', 'Traveling', 'Gaming', 'Cooking'],
            ],
        ];

        // Initialize answers array
        foreach ($this->questions as $question) {
            $this->answers[$question['id']] = [];
        }
    }

    public function submitAnswers()
    {
        $this->submittedAnswers = [];
        foreach ($this->questions as $question) {
            $this->submittedAnswers[] = [
                'question_id' => $question['id'],
                'question_text' => $question['text'],
                'selected_answers' => $this->answers[$question['id']],
            ];
        }
        $this->dispatch('nextStep');

        session()->flash('message', 'Your answers have been submitted!');
    }
    public function render()
    {
        return view('livewire.question-answer');
    }
}
