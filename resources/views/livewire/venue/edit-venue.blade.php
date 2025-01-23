<div>
      <div class="max-w-3xl p-6 mx-auto bg-white rounded-lg shadow">
            <h2 class="mb-6 text-2xl font-bold text-gray-700">Edit Venue</h2>
            <form wire:submit.prevent="editVenue"  class="space-y-4">
                <!-- Activity-->
                <div>
                    <label for="full-name" class="block text-sm font-medium text-gray-600">Venue Name</label>
                    <input type="text" id="full-name" wire:model="name" placeholder="Enter your venue name" value="{{ old('name', $name) }}"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg cursor-text focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Venue -->
                <div>
                    <label for="full-name" class="block text-sm font-medium text-gray-600"> Address</label>
                    <input type="text" id="full-name" wire:model="address" placeholder="Enter Address" value="{{ old('venue', $address) }}"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg cursor-text focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('address')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>


                  <!-- Postal Code -->
                <div>
                    <label for="full-name" class="block text-sm font-medium text-gray-600">Post Code</label>
                    <input type="text" id="full-name" wire:model="postal_code" placeholder="Enter post code"value="{{ old('postal_code', $postal_code) }}"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg cursor-text focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('postal_code')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Submit Button -->
                <div class="flex gap-x-5">
                    <button type="submit"
                        class="px-4 py-2 mt-6 text-white bg-black rounded-lg !w-full  focus:outline-none focus:ring focus:ring-blue-200">
                        Edit Venue
                    </button>
                </div>
            </form>
        </div>

</div>
