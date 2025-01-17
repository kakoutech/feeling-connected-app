<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Activity extends Component
{
    public $headers = ['Id','Name','Venue','Organiser'];
    public $rows = [];
    public $user_role;

    public function mount(){
        $this->user_role = Auth::user()->role;

        if($this->user_role ==="admin"){
            $activities = DB::table('activities')
            ->join('venues', 'activities.venue_id', '=', 'venues.id')
            ->join('organisers', 'activities.organiser_id', '=', 'organisers.id')
            ->select(
                'activities.id as activity_id',
                'activities.name as activity_name',
                'venues.name as venue_name', 
                'organisers.name as organizer_name',
                'activities.created_at'
            )
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->activity_id,
                    'name' => $item->activity_name,
                    'venue_name' => $item->venue_name,
                    'organizer_name' => $item->organizer_name,
                ];
            })
            ->toArray();
        }else{
            $activities = DB::table('activities')
            ->join('venues', 'activities.venue_id', '=', 'venues.id')
            ->join('organisers', 'activities.organiser_id', '=', 'organisers.id')
            ->where('activities.user_id', Auth::id())
            ->select(
                'activities.id as activity_id',
                'activities.name as activity_name',
                'venues.name as venue_name', 
                'organisers.name as organizer_name',
                'activities.created_at'
            )
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->activity_id,
                    'name' => $item->activity_name,
                    'venue_name' => $item->venue_name,
                    'organizer_name' => $item->organizer_name,
                ];
            })
            ->toArray();
        }

        $this->rows = $activities;
    }

    public function deleteActivity($id) {
        try{
            DB::beginTransaction();
            $result =   DB::table('activities')->where('id', $id)->delete();
            if($result){
                toastr()->success('Activity deleted successfully!');
                DB::commit();
                $this->mount();
            }
        }
        catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('An error occurred while deleting. Please try again.');
        }

    }

    public function render()
    {
        return view('livewire.activity');
    }
}
