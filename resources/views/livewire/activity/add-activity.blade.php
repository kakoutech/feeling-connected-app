<div>
      <div class="max-w-3xl p-6 mx-auto bg-white rounded-lg shadow">
            <h2 class="mb-6 text-2xl font-bold text-gray-700">Responsive Form</h2>
            <form wire:submit.prevent="saveData" method="POST" class="space-y-4">
                <!-- Full Name -->
                <div>
                    <label for="full-name" class="block text-sm font-medium text-gray-600">Full Name</label>
                    <input type="text" id="full-name" wire:model="formData.name" placeholder="Enter your full name"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('formData.name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" id="email" wire:model="formData.email" placeholder="Enter your email"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('formData.email')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                    <input type="password" id="password" wire:model="formData.password"
                        placeholder="Enter your password"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('formData.password')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="confirm-password" class="block text-sm font-medium text-gray-600">Confirm
                        Password</label>
                    <input type="password" id="confirm-password" wire:model="formData.confirmPass"
                        placeholder="Confirm your password"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
                    @error('formData.confirmPass')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 mt-6 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200">
                        Submit
                    </button>
                </div>
            </form>
        </div>

</div>
