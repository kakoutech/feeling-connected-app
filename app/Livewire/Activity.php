<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Activity extends Component
{

    public $headers = ['Id','Name', 'Venue', 'Postal Code', 'Created Date'];
    public $rows = [];

    public function mount(){
        $activities = DB::table('activities')->select('id','name','venue', 'postal_code','created_at')->get()->map(function ($item) {
            return [
                'id'=>$item->id,
                $item->name,
                $item->venue,
                $item->postal_code,
                $item->created_at,
            ];
        })->toArray();
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
