<div class="max-w-3xl p-6 mx-auto bg-white border rounded-lg shadow">
    <!-- Step 1: Dropdowns and Calendar -->
    @if ($step === 1)
        <div>
            <h2 class="mb-4 text-lg font-semibold">Step 1: Fill in the details</h2>
            <!-- Passcode Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Postal Code</label>
                <input type="text" wire:model="passcode" placeholder="Enter Your Postal Code"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('passcode')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Activity -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Select Activity</label>
                <select wire:model="selected_activity" wire:change="getSurveyAgainstSelectedActivity    "
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Choose Activity...</option>
                    @foreach ($activitiesFromDb as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>
                @error('selected_activity')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

          <!-- Surveys -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Select Survey</label>
                <select wire:model="selected_survey"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="" selected>Choose Survey...</option>
                    @foreach ($surveysAgainstActivity as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>
                @error('selected_survey')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <!-- Calendar -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" wire:model="date"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('date')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <!-- Continue Button -->
            <button wire:click="nextStep" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Continue
            </button>
        </div>
    @endif

    <!-- Step 3: Start Survey -->
    @if ($step === 2)
        <div>
            <h2 class="mb-4 text-lg font-semibold">Step 2: Start the Survey</h2>
            <button wire:click="nextStep" class="px-6 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
                Start Survey
            </button>
            @if (session()->has('message'))
                <p class="mt-4 text-green-600">{{ session('message') }}</p>
            @endif
        </div>
    @endif

    @if ($step === 3)
        <livewire:question-answer :survey-id="$surveyId" :allValuesArray="$allValuesArray" />
    @endif

    @if ($step === 4)
        <p> Thanks for submitting the form</p>
        <button wire:click="initialStep" class="px-6 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
            Done
        </button>
    @endif
</div>
