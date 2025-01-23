<div class="max-w-full p-6 mx-auto space-y-6 bg-white rounded-lg shadow">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <a href="{{ route('dashboard.activity.add') }}">
        <x-primary-button>Create Activity</x-primary-button>
    </a>

    <table class="w-full border-collapse rounded-lg shadow-md table-auto">
        <thead>
            <tr class="bg-gray-100">
                @foreach ($headers as $header)
                    <th class="px-6 py-4 font-semibold text-gray-700 uppercase border-b border-gray-300">
                        {{ $header }}
                    </th>
                @endforeach
                <!-- Action Column -->
                <th class="px-6 py-4 font-semibold text-gray-700 uppercase border-b border-gray-300">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="transition-colors duration-200 hover:bg-gray-100">
                    @foreach ($row as $column)
                        <td class="px-6 py-4 text-center text-gray-700 border-b border-gray-300">
                            {{ $column }}
                        </td>
                    @endforeach

                    <!-- Action Buttons (Edit and Delete) -->
                    <td class="px-6 py-4 text-center text-gray-700 border-b border-gray-300">
                        <div class="flex justify-center space-x-4">
                            <!-- Edit Button -->
                            <a class="text-blue-500 hover:text-blue-700"
                                href="{{ route('dashboard.activity.edit', ['id' => $row['id']]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none"
                                    width="35" height="35">
                                    <circle cx="16.0527" cy="16.1221" r="15.5" fill="black" />
                                    <path fillRule="evenodd" clipRule="evenodd"
                                        d="M13.1555 22.8965L22.8271 13.2249L18.9499 9.34766L9.27832 19.0193V22.8965H13.1555ZM18.9499 11.0574L21.1175 13.2249L19.5544 14.788L17.3869 12.6204L18.9499 11.0574ZM16.532 13.4753L18.6996 15.6428L12.6548 21.6875H10.4873V19.52L16.532 13.4753Z"
                                        fill="white" />
                                </svg>
                            </a>
                            <button type="submit" wire:click='deleteActivity({{ $row['id'] }})'
                                class="text-red-500 hover:text-red-700">
                                <svg width="35" height="35" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <ellipse cx="11.897" cy="12" rx="11.8169" ry="12"
                                        fill="black" />
                                    <path d="M10.6035 10.8984V14.8382" stroke="white" strokeWidth="1.5"
                                        strokeLinecap="round" strokeLinejoin="round" />
                                    <path d="M13.1914 10.8984V14.8382" stroke="white" strokeWidth="1.5"
                                        strokeLinecap="round" strokeLinejoin="round" />
                                    <path d="M6.72461 8.26953H17.0703" stroke="white" strokeWidth="1.5"
                                        strokeLinecap="round" strokeLinejoin="round" />
                                    <path
                                        d="M8.01758 8.26953H11.8972H15.7769V15.4924C15.7769 16.5804 14.9084 17.4623 13.837 17.4623H9.9574C8.88607 17.4623 8.01758 16.5804 8.01758 15.4924V8.26953Z"
                                        stroke="white" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" />
                                    <path
                                        d="M9.95703 6.95779C9.95703 6.2325 10.536 5.64453 11.2502 5.64453H12.5435C13.2577 5.64453 13.8367 6.2325 13.8367 6.95779V8.27104H9.95703V6.95779Z"
                                        stroke="white" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
