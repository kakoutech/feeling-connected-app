<div>
      <div class="max-w-3xl p-6 mx-auto bg-white rounded-lg shadow">
            <h2 class="mb-6 text-2xl font-bold text-gray-700">Edit Activity</h2>
            <form wire:submit.prevent="editActivity"  class="space-y-4">
                <!-- Activity-->
                <div>
                    <label for="full-name" class="block text-sm font-medium text-gray-600">Activity Name</label>
                    <input type="text" id="full-name" wire:model="name" placeholder="Enter your activity name" value="{{ old('name', $name) }}"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

         <!-- Venue -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Select Venue</label>
                        <select 
                            wire:model="venue" 
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Choose...</option>
                            @foreach($venues as $option)
                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                            @endforeach
                        </select>
                        @error("venue") <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>


                  <!-- Postal Code -->
                <div>
                    <label for="full-name" class="block text-sm font-medium text-gray-600">Postal Code</label>
                    <input type="text" id="full-name" wire:model="postal_code" placeholder="Enter postal code"value="{{ old('postal_code', $postal_code) }}"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('postal_code')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Submit Button -->
                <div class="flex gap-x-5">
                  <button wire:click='backActivity'
                        class="px-4 py-2 mt-6 text-white bg-green-600 rounded-lg !w-1/2 hover:bg-green-700 focus:outline-none focus:ring focus:ring-blue-200">
                        Back
                    </button>
                    <button type="submit"
                        class="px-4 py-2 mt-6 text-white bg-blue-600 rounded-lg !w-1/2 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200">
                        Edit
                    </button>
                </div>
            </form>
        </div>

</div>
