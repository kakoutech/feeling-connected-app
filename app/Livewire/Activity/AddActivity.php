<?php

namespace App\Livewire\Activity;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Support\Facades\Auth;

class AddActivity extends Component
{
    public $name='';
    public $venue = '';
    public $venues = [];
    public $organizer = '';
    public $organizers = [];


    public function mount(){
        $venues = DB::table('venues')->where('user_id', Auth::id())->select('id','name')->get()->toArray();
        $organizers = DB::table('users')->where('role', 'organizer')->select('id','name')->get()->toArray();
        $this->venues = $venues;
        $this->organizers = $organizers;
    }

    public function saveData()
    {

        $this->validate(
            [
                'name' => 'required|string|max:255',
                'venue' => 'required',
                'organizer' => 'required',
            ],
            [
                'required' => 'This field is required.',
            ]
        );

        $payload = [
            'name' => $this->name,
            'venue_id' => $this->venue,
            'organizer_id' => $this->organizer,
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
    }
    public function render()
    {
        return view('livewire.activity.add-activity');
    }
}
