<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Organizer extends Component
{
    public $headers = ['Id','Name', 'Email', 'Phone', 'created_at'];

    public $rows = [];

    public function mount(){
        $organizer = DB::table('users')->where('role', 'organizer')->select('id','name','email', 'phone','created_at')->get()->map(function ($item) {
            return [
                'id'=>$item->id,
                $item->name,
                $item->email,
                $item->phone,
                $item->created_at,
            ];
        })->toArray();
        $this->rows = $organizer;
    }

    public function deleteOrganizer($id) {
        try{
            DB::beginTransaction();
            $result =   DB::table('users')->where('id', $id)->delete();
            if($result){
                toastr()->success('Organiser deleted successfully!');
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
        return view('livewire.organizer');
    }
}
