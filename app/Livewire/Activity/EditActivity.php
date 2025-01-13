<?php

namespace App\Livewire\Activity;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditActivity extends Component
{
    public $name = '';
    public $venue = '';
    public $postal_code = '';
    public $id;
    public $venues = [];
    public function mount($id)
    {
        $this->id = $id;
        $activity = DB::table("activities")->find($id);
        if ($activity) {
            $this->name = $activity->name;
            $this->venue = $activity->venue_id;
            $this->postal_code = $activity->postal_code;
                 $this->venues = DB::table('venues')
                 ->where('user_id', Auth::id())
                 ->select('id', 'name')
                 ->get();
        } else {
            session()->flash('error', 'Activity not found.');
            toastr()->error('AActivity not found.');
        }
    }

    public function editActivity()
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
            'created_at' => now(),
            'updated_at' => now()
        ];
        try {
            DB::beginTransaction();
            $activity = DB::table('activities')->where('id', $this->id)->first();

            if ($activity) {
                $response = DB::table('activities')->where('id', $this->id)->update($payload);

                if ($response) {
                    toastr()->success('Activity Updated Successfully!');

                    DB::commit();
                    return redirect()->route('dashboard.activity');
                }
            } else {
                toastr()->error('Activity not found!');
                DB::rollBack();
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            DB::rollBack();
        }
    }

    public function backActivity(){
        return redirect()->route('dashboard.activity');
    }

    public function render()
    {
        return view('livewire.activity.edit-activity');
    }
}
