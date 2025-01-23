<?php

namespace App\Livewire\Venue;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditVenue extends Component
{

    public $name='';
    public $address='';
    public $postal_code='';
    public $id;
    public function mount($id)
    {
        $this->id = $id;
        $venue = DB::table("venues")->find($id);
        if ($venue) {
            $this->name = $venue->name;
            $this->address = $venue->address;
            $this->postal_code = $venue->postal_code;
        } else {
            session()->flash('error', 'Venue not found.');
            toastr()->error('Venue not found.');
        }
    }

    public function editVenue()
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
        try {
            DB::beginTransaction();
            $venue = DB::table('venues')->where('id', $this->id)->first();

            if ($venue) {
                $response = DB::table('venues')->where('id', $this->id)->update($payload);

                if ($response) {
                    toastr()->success('Venue Updated Successfully!');

                    DB::commit();
                    return redirect()->route('dashboard.venue');
                }
            } else {
                toastr()->error('Venue not found!');
                DB::rollBack();
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.venue.edit-venue');
    }
}
