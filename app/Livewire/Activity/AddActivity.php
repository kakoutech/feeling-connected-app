<?php

namespace App\Livewire\Activity;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Flasher\Toastr\Prime\ToastrInterface;

class AddActivity extends Component
{
    public $name='';
    public $venue='';
    public $postal_code='';

    public function saveData()
    {

        $this->validate(
            [
                'name' => 'required|string|max:255',
                'venue' => 'required|string|max:255',
                'postal_code' => 'required|string',
            ],
            [
                'required' => 'This field is required.',
            ]
        );

        $payload = [
            'name' => $this->name,
            'venue' => $this->venue,
            'postal_code' => $this->postal_code,
            'created_at' => now(),
            'updated_at' => now()
        ];
        try{
            DB::beginTransaction();

            $response= DB::table('activities')->insert($payload);
            if($response){
                toastr()->success('Activity Created Successfully!.');
                redirect()->route('dashboard.activity');
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
        $this->venue= "";
        $this->postal_code= "";
    }
    public function render()
    {
        return view('livewire.activity.add-activity');
    }
}
