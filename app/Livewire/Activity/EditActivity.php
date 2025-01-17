<?php

namespace App\Livewire\Activity;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditActivity extends Component
{
    public $name = '';
    public $venue = '';
    public $id;
    public $venues = [];
    public $organizers = [];
    public $organizer = '';

    public function mount($id)
    {
        $this->id = $id;
        $activity = DB::table("activities")->find($id);
        if ($activity) {
            $this->name = $activity->name;
            $this->venue = $activity->venue_id;
            $this->organizer = $activity->organiser_id;
            $this->venues = DB::table('venues')
                 ->where('user_id', Auth::id())
                 ->select('id', 'name')
                 ->get();
            $this->organizers = DB::table('organisers')
                 ->where('fc_admin_id', Auth::id())
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
                'organizer' => 'required',
            ],
            [
                'required' => 'This field is required.',
            ]
        );

        $payload = [
            'name' => $this->name,
            'venue_id' => $this->venue,
            'organiser_id' => $this->organizer,
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

    public function render()
    {
        return view('livewire.activity.edit-activity');
    }
}
