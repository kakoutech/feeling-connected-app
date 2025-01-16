<?php

namespace App\Livewire\Organizer;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddOrganizer extends Component
{
    public $name='';
    public $email='';
    public $phone='';
    public $role='organizer';

    public function saveData()
    {

        $this->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required',
                'phone' => 'required',
            ],
            [
                'required' => 'This field is required.',
            ]
        );

        $payload = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'password' => "",
            'created_at' => now(),
            'updated_at' => now()
        ];
        try{
            DB::beginTransaction();

            $response= DB::table('users')->insert($payload);
            if($response){
                toastr()->success('Organiser Created Successfully!.');
                redirect()->route('dashboard.organiser');
                $this->resetForm();
            }
            DB::commit();

        }catch(\Exception $e){
            toastr()->error($e->getMessage());
            DB::rollBack();
        }

    }


    public function resetForm()
    {
        $this->name="";
        $this->email= "";
        $this->phone= "";
    }

    public function render()
    {
        return view('livewire.organizer.add-organizer');
    }
}
