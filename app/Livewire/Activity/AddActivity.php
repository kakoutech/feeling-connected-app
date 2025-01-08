<?php

namespace App\Livewire\Activity;

use Livewire\Component;

class AddActivity extends Component
{
    public $formData;

    public function mount()
    {
        $this->formData = (object) [
            'name' => '',
            'email' => '',
            'password' => '',
            'confirmPass' => '',
        ];
    }

    protected function rules()
    {
        return [
            'formData.name' => 'required|string|max:255',
            'formData.email' => 'required|email|max:255',
            'formData.password' => 'required|string|min:6',
            'formData.confirmPass' => 'required|same:formData.password',
        ];
    }

    public function saveData()
    {
        // Validate the form inputs
        $validatedData = $this->validate();
        dd($validatedData);

        // Extract validated data from the object
        $payload = [
            'name' => $this->formData->name,
            'email' => $this->formData->email,
            'password' => $this->formData->password,
        ];

        dd($payload);

        // Make the API call
        // $response = Http::post('https://api.example.com/endpoint', $payload);

        // // Check response and handle accordingly
        // if ($response->successful()) {
            session()->flash('success', 'Form submitted successfully!');
        //     $this->resetForm();
        // } else {
        //     session()->flash('error', 'There was an issue submitting the form.');
        // }
    }

    public function resetForm()
    {
        $this->formData = (object) [
            'name' => '',
            'email' => '',
            'password' => '',
            'confirmPass' => '',
        ];
    }
    public function render()
    {
        return view('livewire.activity.add-activity');
    }
}
