<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ServayWizard extends Component
{
    public $step = 1;
    public $dropdowns = [];
    public $allValuesArray=[];
    public $date;
    public $passcode;

    public $name;
    public $email;
    public $phone;

    public $surveyId =-1;
    public $dropdownOptions = [];

    protected $listeners = ['nextStep'];

    public function mount()
    {
        $this->dropdowns = array_fill(0, count($this->dropdownOptions), null);
        // $names = DB::table('survey_questions')->select('id', 'name')->get();

        // Assign options to the dropdown
        $this->dropdownOptions = [
            // [
            //     'label' => 'Select Name',
            //     'options' => ['Option A', 'Option B', 'Option C'],
            // ],
            [
                'label' => 'Select Activity',
                'options' => DB::table('activities')->select('id', 'name')->get()->toArray(),
            ],
            [
                'label' => 'Select Survey',
                'options' => DB::table('surveys')->select('id', 'name')->get()->toArray(),
            ],
            //        [
            //     'label' => 'Select Activity',
            //     'options' => DB::table('activities')->select('id', 'name')->get()->pluck('name')->toArray(),
            // ],
            // [
            //     'label' => 'Select Survey',
            //     'options' => DB::table('surveys')->select('id', 'name')->get()->pluck('name')->toArray(),
            // ],
        ];

        // [
        //     'label' => 'Select Activity',
        //     'options' => DB::table('activities')->select('id', 'name')->get()->pluck('name')->toArray(),
        // ],
        // [
        //     'label' => 'Select Survey',
        //     'options' => DB::table('surveys')->select('id', 'name')->get()->pluck('name')->toArray(),
        // ],

        //   dd($this->dropdownOptions);
    }


    public function getSurveyValue()
    {
        foreach ($this->dropdowns as $key => $dropdown) {
            // Check if the label is "survey"
            if ($this->dropdownOptions[$key]['label'] === 'Select Survey') {
                foreach ($this->dropdownOptions[$key]['options'] as $option) {
                    // Match the dropdown value with the option ID
                    if ($dropdown == $option->id) {
                        return $option->id; // Return the matching option name
                    }
                }
            }
        }

        return $this->surveyId; // Return null if no match is found
    }

    public function getAllValues(){
        foreach($this->dropdowns as $key => $dropdown){
            if ($this->dropdownOptions[$key]['label'] === 'Select Activity') {
            foreach ( $this->dropdownOptions[$key]['options']  as $option ){
                if ($dropdown == $option->id){
                    $option->name;
                    return [
                            "activityId"=> $option->id,
                            "name"=> $this->name,
                            "email"=> $this->email,
                            "phone"=> $this->phone,
                            "passcode"=> $this->passcode,
                            "date"=> $this->date,
                    ];
                }
                }
            }
        }
        return [
            "activityId"=> null,
            "name"=> $this->name,
            "email"=> $this->email,
            "phone"=> $this->phone,
            "passcode"=> $this->passcode,
            "date"=> $this->date,
    ];
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
        if($this->step === 3){
            $this->surveyId = $this->getSurveyValue();
            $this->allValuesArray= $this->getAllValues();
        }
        // dd($this->dropdowns);
    }

    public function initialStep()
    {
        $this->dropdowns = [];
        $this->date = '';
        $this->passcode = '';

        $this->name = '';
        $this->email= '';
        $this->phone= '';
    
        $this->step = 1;
    }

    public function validateStep()
    {
        if ($this->step === 1) {
            $this->validate(
                [
                    'dropdowns.*' => 'required',
                    'date' => 'required|date',
                    'name' => 'required|string',
                    'email' => 'required|string',
                    'phone' => 'required|string',
                    'passcode' => 'required|string',
                ],
                [
                    'required' => 'This field is required.',
                ]
            );
        } 
        // elseif ($this->step === 2) {
        //     $this->validate(
        //         [
        //             'passcode' => 'required|min:4',
        //         ],
        //         [
        //             'required' => 'This field is required.',
        //         ]
        //     );
        // }
    }

    public function startSurvey()
    {
        // $this->step++;
        // Handle starting the survey
        session()->flash('message', 'Survey started!');
    }

    public function render()
    {
        return view('livewire.servay-wizard');
    }
}
