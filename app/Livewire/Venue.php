<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Venue extends Component
{
    public $headers = ['Id','Name', 'Address', 'Postal Code','created_at'];
    public $rows = [];

    public function mount(){
        $venues = DB::table('venues')->select('id','name','address', 'postal_code','created_at')->get()->map(function ($item) {
            return [
                'id'=>$item->id,
                $item->name,
                $item->address,
                $item->postal_code,
                $item->created_at,
            ];
        })->toArray();
        $this->rows = $venues;
    }

    public function deleteVenue($id) {
        try{
            DB::beginTransaction();
            $result =   DB::table('venues')->where('id', $id)->delete();
            if($result){
                toastr()->success('Venue deleted successfully!');
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
        return view('livewire.venue');
    }
}
