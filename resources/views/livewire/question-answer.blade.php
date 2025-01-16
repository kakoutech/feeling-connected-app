<div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow">
    <h2 class="mb-6 text-xl font-semibold">Survey Questions</h2>

    <form wire:submit.prevent="submitAnswers">
        <!-- Loop through questions -->
        @foreach($questions as $question)
            <div class="pb-4 mb-6 border-b">
                <h3 class="mb-2 text-lg font-medium">{{ $question['text'] }}</h3>

                <!-- Options as checkboxes -->
                <div class="space-y-2">
                    @foreach($question['options'] as $option)
                        <label class="flex items-center">
                        @if ($question['option_type'] == 'Toggle')
                             <input 
                                type="radio" 
                                wire:model="answers.{{ $question['id'] }}" 
                                value="{{ $option }}" 
                                class="w-5 h-5 text-blue-600 form-checkbox">
                            <span class="ml-3 text-gray-700">{{ $option }}</span>

                        @elseif ($question['option_type'] == 'Multiple Choice')
                              <input 
                                type="checkbox" 
                                wire:model="answers.{{ $question['id'] }}" 
                                value="{{ $option }}" 
                                class="w-5 h-5 text-blue-600 form-checkbox">
                            <span class="ml-3 text-gray-700">{{ $option }}</span>
                        
                        @elseif ($question['option_type'] == 'Free Text')
                                    <textarea 
                                        
                                        wire:model="answers.{{ $question['id'] }}" 
                                        rows="4" 
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm resize-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Enter your answer"></textarea>
                        @endif
                           
                        </label>
                    @endforeach
                </div>

                <!-- Validation Error (if needed in the future) -->
                @error("answers.{$question['id']}") 
                    <span class="text-sm text-red-500">{{ $message }}</span> 
                @enderror
            </div>
        @endforeach

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Submit Answers
        </button>
    </form>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div>
