<?php

namespace App\Livewire\Activity;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Support\Facades\Auth;

class AddActivity extends Component
{
    public $name='';
    public $postal_code='';
    public $venue = '';
    public $venues = [];


    public function mount(){
        $venues = DB::table('venues')->where('user_id', Auth::id())->select('id','name')->get()->toArray();
        $this->venues = $venues;
    }

    public function saveData()
    {

        $this->validate(
            [
                'name' => 'required|string|max:255',
                'venue' => 'required',
                'postal_code' => 'required|string',
            ],
            [
                'required' => 'This field is required.',
            ]
        );

        $payload = [
            'name' => $this->name,
            'venue_id' => $this->venue,
            'postal_code' => $this->postal_code,
            'user_id' => Auth::id(),
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
        // $this->venue= "";
        $this->postal_code= "";
    }
    public function render()
    {
        return view('livewire.activity.add-activity');
    }
}
