<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Organizer extends Component
{
    public $headers = ['Id','Name', 'Email', 'Phone', 'created_at'];

    public $rows = [];
    public $user_role;

    public function mount(){
        $this->user_role = Auth::user()->role;
        if($this->user_role ==='admin'){
            $organizer = DB::table('organisers')->select('id','name','email', 'phone','created_at')->get()->map(function ($item) {
                return [
                    'id'=>$item->id,
                    $item->name,
                    $item->email,
                    $item->phone,
                    $item->created_at,
                ];
            })->toArray();

        }else{
            $organizer = DB::table('organisers')->where('fc_admin_id', Auth::id())->select('id','name','email', 'phone','created_at')->get()->map(function ($item) {
                return [
                    'id'=>$item->id,
                    $item->name,
                    $item->email,
                    $item->phone,
                    $item->created_at,
                ];
            })->toArray();

        }
   
        $this->rows = $organizer;
    }

    public function deleteOrganizer($id) {
        try{
            DB::beginTransaction();
            $result =   DB::table('organisers')->where('id', $id)->delete();
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
