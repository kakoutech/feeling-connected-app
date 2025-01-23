<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ServayWizard extends Component
{
    public $step = 1;
    public $allValuesArray = [];
    public $date;
    public $passcode;
    public $surveyId = -1;
    public $selected_activity;
    public $activitiesFromDb = [];
    public $selected_survey;
    public $surveysAgainstActivity = [];

    protected $listeners = ['nextStep'];

    public function mount()
    {
        $activitiesFromDb = DB::table('activities')->select('id', 'name')->get()->toArray();
        $this->activitiesFromDb = $activitiesFromDb;
    }

    public function getSurveyAgainstSelectedActivity()
    {
        $this->selected_survey = null;
        $this->surveysAgainstActivity = [];
        $surveys = DB::table('surveys')->where('activity_id', $this->selected_activity)->select('id', 'name')->get()->toArray();
        $this->surveysAgainstActivity = $surveys;
    }

    public function getAllValues()
    {
        return [
            "activityId" => $this->selected_activity,
            "passcode" => $this->passcode,
            "date" => $this->date,
        ];
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
        if ($this->step === 3) {
            $this->surveyId = $this->selected_survey;
            $this->allValuesArray = $this->getAllValues();
        }
    }

    public function initialStep()
    {
        $this->date = '';
        $this->passcode = '';
        $this->step = 1;
        $this->selected_activity = null;
        $this->selected_survey = null;
        $this->surveysAgainstActivity = [];
    }
    public function validateStep()
    {
        if ($this->step === 1) {
            $this->validate(
                [
                    'selected_activity' => 'required',
                    'selected_survey' => 'required',
                    'date' => 'required|date',
                    'passcode' => 'required|string',
                ],
                [
                    'required' => 'This field is required.',
                ]
            );
        }
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
