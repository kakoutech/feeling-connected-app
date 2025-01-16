<div>
      <div class="max-w-3xl p-6 mx-auto bg-white rounded-lg shadow">
            <h2 class="mb-6 text-2xl font-bold text-gray-700">Edit Organiser</h2>
            <form wire:submit.prevent="editOrganizer"  class="space-y-4">
                <!-- Name-->
                <div>
                    <label for="full-name" class="block text-sm font-medium text-gray-600">Organiser Name</label>
                    <input type="text" id="full-name" wire:model="name" placeholder="Enter your rganizer name" value="{{ old('name', $name) }}"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="full-name" class="block text-sm font-medium text-gray-600"> Email</label>
                    <input type="text" id="full-name" wire:model="email" placeholder="Enter email" value="{{ old('email', $email) }}"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('email')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>


                  <!-- Phone -->
                <div>
                    <label for="full-name" class="block text-sm font-medium text-gray-600">Phone</label>
                    <input type="text" id="full-name" wire:model="phone" placeholder="Enter phone"value="{{ old('phone', $phone) }}"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('phone')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Submit Button -->
                <div class="flex gap-x-5">
                    <button type="submit"
                        class="px-4 py-2 mt-6 text-white bg-black rounded-lg !w-full focus:outline-none focus:ring focus:ring-blue-200">
                        Edit Organiser
                    </button>
                </div>
            </form>
        </div>

</div>
