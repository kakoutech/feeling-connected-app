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
                    <div class="flex justify-center space-x-8">
                        <!-- Edit Button -->
                        {{-- href="{{ route('edit.route', ['id' => $row['id']]) }}"  --}}
                        <a class="text-blue-500 hover:text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232a4.5 4.5 0 016.364 6.364l-11.778 11.778a2 2 0 01-.796.494l-5.64 1.416a1 1 0 01-1.208-1.208l1.416-5.64a2 2 0 01.494-.796L13.768 9.768a4.5 4.5 0 010-6.364z" />
                            </svg>
                        </a>
                        <!-- Delete Button -->
                                                {{-- <form action="{{ route('delete.route', ['id' => $row['id']]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')"> --}}

                        <form onsubmit="return confirm('Are you sure you want to delete this?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
