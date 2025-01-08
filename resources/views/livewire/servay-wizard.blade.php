<div class="max-w-3xl p-6 mx-auto bg-white rounded-lg shadow">
    <!-- Step 1: Dropdowns and Calendar -->
    @if($step === 1)
        <div>
            <h2 class="mb-4 text-lg font-semibold">Step 1: Fill in the details</h2>

            <!-- Name Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input 
                    type="text" 
                    wire:model="name" 
                    placeholder="Enter Your Name" 
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                    type="email" 
                    wire:model="email" 
                    placeholder="Enter Your Email" 
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <!-- Phone Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input 
                    type="text" 
                    wire:model="phone" 
                    placeholder="Enter Your Phone" 
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('phone') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Passcode Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">PostCode</label>
                <input 
                    type="text" 
                    wire:model="passcode" 
                    placeholder="Enter Your PostCode" 
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('passcode') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>


            <!-- Dropdowns -->
            @foreach($dropdownOptions as $index => $dropdown)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ $dropdown['label'] }}</label>
                    <select 
                        wire:model="dropdowns.{{ $index }}" 
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Choose...</option>
                        @foreach($dropdown['options'] as $option)
                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                        @endforeach
                    </select>
                    @error("dropdowns.{$index}") <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            @endforeach


            <!-- Calendar -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Date</label>
                <input 
                    type="date" 
                    wire:model="date" 
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('date') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>


            <!-- Continue Button -->
            <button 
                wire:click="nextStep" 
                class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Continue
            </button>
        </div>
    @endif

    <!-- Step 2: Passcode Field -->
    {{-- @if($step === 2)
        <div>
            <h2 class="mb-4 text-lg font-semibold">Step 2: Verify Details</h2>

            <!-- Display Selected Data -->
            <div class="mb-4">
                <h3 class="font-semibold text-gray-700">Your Details:</h3>
                <ul class="pl-5 space-y-2 list-disc">   
                    @foreach($dropdowns as $key => $dropdown)
                        @foreach ( $dropdownOptions[$key]['options']  as $option )
                            @if ($dropdown == $option->id)
                                <li>{{ $dropdownOptions[$key]['label'] }}: <strong>{{ $option->name }}</strong></li>
                            @endif
                        @endforeach
                    @endforeach
                </ul>
                <p class="mt-2">Selected Date: <strong>{{ $date }}</strong></p>
            </div>


            <!-- Continue Button -->
            <button 
                wire:click="nextStep" 
                class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Continue
            </button>
        </div>
    @endif --}}

    <!-- Step 3: Start Survey -->
    @if($step === 2)
        <div>
            <h2 class="mb-4 text-lg font-semibold">Step 2: Start the Survey</h2>
            <button 
                wire:click="nextStep"    
                class="px-6 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
                Start Survey
            </button>
            @if (session()->has('message'))
                <p class="mt-4 text-green-600">{{ session('message') }}</p>
            @endif
        </div>
    @endif

        @if ($step===3)
            <livewire:question-answer :survey-id="$surveyId" :allValuesArray="$allValuesArray"/>
        @endif

       @if ($step === 4)
            <p> Thanks for submitting the form</p>
              <button 
                wire:click="initialStep"    
                class="px-6 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
                Done
            </button>
    @endif
</div>
