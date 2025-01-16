<div>

    @if ($step === 1)

        <form wire:submit.prevent="submit" class="max-w-full p-6 mx-auto space-y-6 bg-white rounded-lg shadow">

            <!-- Survey Title -->
            <div>
                <input type="text" wire:model="servay_name" placeholder="Enter Survey Title"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('servay_name')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Activity -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Select Activity</label>
                <select wire:model="activity"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Choose...</option>
                    @foreach ($activities as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>
                @error('activity')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Questions Grid -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

                @foreach ($questions as $index => $question)
                    <div class="p-4 border border-gray-300 rounded-lg bg-gray-50">

                        <!-- Remove Question Button -->
                        <div class="flex justify-end mb-4">
                            <button type="button" wire:click="removeQuestion({{ $index }})"
                                class="text-sm text-white rounded-md ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 13 14" fill="none">
                                    <path
                                        d="M7.98351 7.22021L12.4366 2.76709C12.648 2.55612 12.7669 2.26983 12.7671 1.97121C12.7674 1.67259 12.649 1.38609 12.438 1.17474C12.2271 0.9634 11.9408 0.84452 11.6422 0.844256C11.3435 0.843993 11.057 0.962367 10.8457 1.17334L6.39258 5.62646L1.93945 1.17334C1.72811 0.961994 1.44146 0.843262 1.14258 0.843262C0.84369 0.843262 0.557046 0.961994 0.345702 1.17334C0.134357 1.38468 0.015625 1.67133 0.015625 1.97021C0.015625 2.2691 0.134357 2.55574 0.345702 2.76709L4.79883 7.22021L0.345702 11.6733C0.134357 11.8847 0.015625 12.1713 0.015625 12.4702C0.015625 12.7691 0.134357 13.0557 0.345702 13.2671C0.557046 13.4784 0.84369 13.5972 1.14258 13.5972C1.44146 13.5972 1.72811 13.4784 1.93945 13.2671L6.39258 8.81396L10.8457 13.2671C11.057 13.4784 11.3437 13.5972 11.6426 13.5972C11.9415 13.5972 12.2281 13.4784 12.4395 13.2671C12.6508 13.0557 12.7695 12.7691 12.7695 12.4702C12.7695 12.1713 12.6508 11.8847 12.4395 11.6733L7.98351 7.22021Z"
                                        fill="black" />
                                </svg>
                            </button>
                        </div>
                        <!-- Question Text -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Question: {{ $index + 1 }}</label>
                            <input type="text" wire:model="questions.{{ $index }}.question_text"
                                placeholder="Enter question"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error("questions.{$index}.question_text")
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Option Type -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Choose Option Type</label>
                            <select wire:model="questions.{{ $index }}.option_type"
                                wire:change='addFields({{ $index }})'
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Choose...</option>
                                @foreach ($optionTypes as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                            @error("questions.{$index}.option_type")
                                <span class="text-sm text-red-500">{{ $message }} </span>
                            @enderror
                        </div>

                        <!-- Options -->
                        <div class="space-y-3">
                            @foreach ($question['options'] as $optionIndex => $option)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Option
                                        {{ $optionIndex + 1 }}:</label>
                                    <input type="text"
                                        wire:model="questions.{{ $index }}.options.{{ $optionIndex }}"
                                        placeholder="Enter option"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @error("questions.{$index}.options.{$optionIndex}")
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>


                    </div>
                @endforeach
                <div class="flex justify-center ">

                    <div class="flex justify-center w-1/2">
                        <button type="button" wire:click="addQuestion" class="px-6 py-2 text-sm text-black rounded-md">
                            <svg width="40" height="40" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_7838_41993)">
                                    <path
                                        d="M15.9759 7.33334H9.30923V0.666656C9.30923 0.298469 9.01077 0 8.64258 0C8.27439 0 7.97592 0.298469 7.97592 0.666656V7.33331H1.30923C0.941047 7.33334 0.642578 7.63181 0.642578 8C0.642578 8.36819 0.941047 8.66666 1.30923 8.66666H7.97589V15.3333C7.97589 15.7015 8.27436 16 8.64255 16C9.01073 16 9.3092 15.7015 9.3092 15.3333V8.66666H15.9759C16.344 8.66666 16.6425 8.36819 16.6425 8C16.6426 7.63181 16.3441 7.33334 15.9759 7.33334Z"
                                        fill="black" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_7838_41993">
                                        <rect width="16" height="16" fill="white"
                                            transform="translate(0.642578)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>

            <!-- Add Question and Submit Buttons -->
            <div class="flex justify-end">

                @if (count($questions) > 0)
                    <button type="submit" class="px-6 py-2 text-sm text-white bg-black rounded-md">
                        Save Questions
                    </button>
                @endif

            </div>
        </form>
    @endif


    @if ($step === 2)
        <div class='max-w-full p-6 mx-auto space-y-6 bg-white rounded-lg shadow'>

            @if (session()->has('message'))
                <div class="text-lg text-green-700 bg-green-100 rounded-lg " role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <button wire:click='new_servay'
                class="px-6 py-2 text-sm text-white bg-green-600 rounded-md hover:bg-green-700">
                Create Another Survey
            </button>
        </div>
    @endif


</div>
