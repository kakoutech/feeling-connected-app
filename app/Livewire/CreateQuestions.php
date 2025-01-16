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
    public $step = 1;
    public $activity = '';
    public $activities = [];

    public $optionTypes = [
        'multiple_choice' => 'Multiple Choice',
        'free_text' => 'Free Text',
        'toggle' => 'Toggle',
    ];

    public function mount()
    {
        $this->questions[] = [
            'question_text' => '',
            'option_type' => '',
            'options' => [],
        ];
        $activities = DB::table('activities')->where('user_id', Auth::id())->select('id', 'name')->get()->toArray();
        $this->activities = $activities;
    }

    public function addQuestion()
    {
        $this->questions[] = [
            'question_text' => '',
            'option_type' => '',
            'options' => [],
        ];
    }


    public function addFields($index)
    {
        $selectedType = $this->questions[$index]['option_type'];
        if ($selectedType == "Toggle") {
            $this->questions[$index]['options'] = ['', ''];
        } elseif ($selectedType == "Free Text") {
            $this->questions[$index]['options'] = [];
        } else {
            $this->questions[$index]["options"] = ['', '', '', ''];
        }
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
                'questions.*.option_type' => 'required|string|max:255',
                'servay_name' => 'required|string|max:255',
                'activity' => 'required'
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
                'activity_id' => $this->activity,
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

                $opt_type = $questionData['option_type'];

                if (empty($questionData['options']) ){
                    DB::table('survey_question_options')->insert([
                        'survey_question_id' => $questionId,
                        'option' => '',
                        'option_type' => $opt_type,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }else{
                    foreach ($questionData['options'] as $optionText) {
                        DB::table('survey_question_options')->insert([
                            'survey_question_id' => $questionId,
                            'option' => $optionText,
                            'option_type' => $opt_type,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            

          
            }
            DB::commit();

            $this->reset(['questions', 'servay_name', 'activity']);

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

    public function new_servay()
    {
        $this->step = 1;
    }

    public function render()
    {
        return view('livewire.create-questions');
    }
}
