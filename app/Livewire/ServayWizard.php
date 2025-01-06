<?php

namespace App\Livewire;

use Livewire\Component;

class ServayWizard extends Component
{
    public $step = 1;
    public $dropdowns = [];
    public $date;
    public $passcode;

    public $dropdownOptions = [
        ['label' => 'Select Option 1', 'options' => ['Option A', 'Option B', 'Option C']],
        ['label' => 'Select Option 2', 'options' => ['Option 1', 'Option 2', 'Option 3']],
        ['label' => 'Select Option 3', 'options' => ['Value X', 'Value Y', 'Value Z']],
    ];

    protected $listeners = ['nextStep'];

    public function mount()
    {
        $this->dropdowns = array_fill(0, count($this->dropdownOptions), null);
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }

    public function initialStep(){
        $this->dropdowns = [];
        $this->date = '';
        $this->passcode = '';
        $this->step = 1;
    }

    public function validateStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'dropdowns.*' => 'required',
                'date' => 'required|date',
            ],
            [
                'required' => 'This field is required.', 
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'passcode' => 'required|min:4',
            ],
            [
                'required' => 'This field is required.',
            ]);
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
