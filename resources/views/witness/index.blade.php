<x-layout>
    <x-slot:title>Create Witness</x-slot:title>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4">{{ __('Witnesses List') }}</h2>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        <div>

            <a href="{{ route('witness.create') }}"
                class="mb-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                {{ __('Add New Witness') }}
            </a>
            <a href="{{ route('sync') }}"
                class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                {{ __('Synchonize') }}
            </a>
        </div>

        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">{{ __('ID') }}</th>
                    <th class="p-2">{{ __('Full Name') }}</th>
                    <th class="p-2">{{ __('Active') }}</th>
                    <th class="p-2">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($witnesses as $witness)
                    <tr class="border-t">
                        <td class="p-2">{{ $witness->id }}</td>
                        <td class="p-2">{{ $witness->full_name }}</td>
                        <td class="p-2">{{ $witness->active ? __('Yes') : __('No') }}</td>
                        <td class="p-2">
                            <a href="{{ route('witness.edit', $witness->id) }}"
                                class="text-blue-600 hover:underline">{{ __('Edit') }}</a>
                            <form action="{{ route('witness.destroy', $witness->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $witnesses->links() }}
        </div>
    </div>
</x-layout>
