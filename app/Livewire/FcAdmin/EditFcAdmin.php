<?php

namespace App\Livewire\FcAdmin;

namespace App\Livewire\FcAdmin;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class EditFcAdmin extends Component
{

    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public $id;


    public function mount($id){
        $this->id = $id;
        $user = DB::table('users')->find($id);

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
        } else {
            session()->flash('error', 'User not found.');
            toastr()->error('User not found.');
        }
    }

    public function editAdmin()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string']
        ]);

        try {
            DB::beginTransaction();
            $user = DB::table('users')->where('id', $this->id)->first();

            if ($user) {
                $response = DB::table('users')->where('id', $this->id)->update($validated);

                if ($response) {
                    toastr()->success('FC Admin Information Updated Successfully!');

                    DB::commit();
                    return redirect()->route('dashboard.fc-admin');
                }
            } else {
                toastr()->error('FC Admin not found!');
                DB::rollBack();
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            DB::rollBack();
        }
    }
    public function render()
    {
        return view('livewire.fc-admin.edit-fc-admin');
    }
}
