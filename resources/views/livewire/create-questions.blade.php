<div>

    @if ($step === 1)
        <form wire:submit.prevent="submit" class="max-w-full p-6 mx-auto space-y-6 bg-white rounded-lg shadow">

    <!-- Survey Title -->
    <div>
        <input 
            type="text" 
            wire:model="servay_name" 
            placeholder="Enter Survey Title" 
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        >
              @error("servay_name") 
                                <span class="text-sm text-red-500">{{ $message }}</span> 
                            @enderror
    </div>

    <!-- Questions Grid -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($questions as $index => $question)
            <div class="p-4 border border-gray-300 rounded-lg bg-gray-50">
                <!-- Question Text -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Question: {{ $index + 1}}</label>
                    <input 
                        type="text" 
                        wire:model="questions.{{ $index }}.question_text" 
                        placeholder="Enter question" 
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                    @error("questions.{$index}.question_text") 
                        <span class="text-sm text-red-500">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Options -->
                <div class="space-y-3">
                    @foreach($question['options'] as $optionIndex => $option)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Option {{ $optionIndex + 1 }}:</label>
                            <input 
                                type="text" 
                                wire:model="questions.{{ $index }}.options.{{ $optionIndex }}" 
                                placeholder="Enter option" 
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            >
                            @error("questions.{$index}.options.{$optionIndex}") 
                                <span class="text-sm text-red-500">{{ $message }}</span> 
                            @enderror
                        </div>
                    @endforeach
                </div>

                <!-- Remove Question Button -->
                <div class="mt-4">
                    <button
                        type="button"
                        wire:click="removeQuestion({{ $index }})" 
                        class="px-4 py-2 text-sm text-red-600 bg-red-100 rounded-md hover:bg-red-200"
                    >
                        Remove Question
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add Question and Submit Buttons -->
    <div class="flex justify-between">
        <button 
            type="button" 
            wire:click="addQuestion" 
            class="px-6 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700"
        >
            Add New Question
        </button>
        @if (count($questions) > 0)
              <button 
            type="submit" 
            class="px-6 py-2 text-sm text-white bg-green-600 rounded-md hover:bg-green-700"
        >
            Save Questions
        </button>   
        @endif
      
    </div>
</form>
    @endif


    @if ($step === 2)
        <div class='max-w-full p-6 mx-auto space-y-6 bg-white rounded-lg shadow'>
            <p>Successfully Created a Survey</p>
               <button 
               wire:click='new_servay'
            class="px-6 py-2 text-sm text-white bg-green-600 rounded-md hover:bg-green-700"
        >
            Create Another Survey
        </button>
        </div>
    @endif

</div>
