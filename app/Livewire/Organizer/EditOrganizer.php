<?php

namespace App\Livewire\Organizer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditOrganizer extends Component
{
    public $name='';
    public $email='';
    public $phone='';
    public $id='';

    public function mount($id)
    {
        $this->id = $id;
        $organizer = DB::table("organisers")->find($id);
        if ($organizer) {
            $this->name = $organizer->name;
            $this->email = $organizer->email;
            $this->phone = $organizer->phone;
        } else {
            session()->flash('error', 'Organiser not found.');
            toastr()->error('Organiser not found.');
        }
    }


    public function editOrganizer()
    {

        $this->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required',
                'phone' => 'required',
            ],
            [
                'required' => 'This field is required.',
            ]
        );

        $payload = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'fc_Admin_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ];
        try {
            DB::beginTransaction();
            $organizer = DB::table('organisers')->where('id', $this->id)->first();

            if ($organizer) {
                $response = DB::table('organisers')->where('id', $this->id)->update($payload);

                if ($response) {
                    toastr()->success('Organiser Updated Successfully!');

                    DB::commit();
                    return redirect()->route('dashboard.organiser');
                }
            } else {
                toastr()->error('Organiser not found!');
                DB::rollBack();
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.organizer.edit-organizer');
    }
}
