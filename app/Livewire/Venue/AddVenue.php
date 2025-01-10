<?php

namespace App\Livewire\Venue;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddVenue extends Component
{
    public $name='';
    public $address='';
    public $postal_code='';


    public function saveData()
    {

        $this->validate(
            [
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'postal_code' => 'required|string',
            ],
            [
                'required' => 'This field is required.',
            ]
        );

        $payload = [
            'name' => $this->name,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'created_at' => now(),
            'updated_at' => now()
        ];
        try{
            DB::beginTransaction();

            $response= DB::table('venues')->insert($payload);
            if($response){
                toastr()->success('Venues Created Successfully!.');
                redirect()->route('dashboard.venue');
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
        $this->address= "";
        $this->postal_code= "";
    }

    public function render()
    {
        return view('livewire.venue.add-venue');
    }
}
