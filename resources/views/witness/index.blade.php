<x-layout>
    <x-slot:title>Create Witness</x-slot:title>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4">{{ __('Witnesses List') }}</h2>
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

        <x-table>
            <x-slot:header>
                <x-table.tr class="bg-gray-100">
                    <x-table.th>{{ __('ID') }}</x-table.th>
                    <x-table.th>{{ __('Full Name') }}</x-table.th>
                    <x-table.th>{{ __('Active') }}</x-table.th>
                    <x-table.th>{{ __('Actions') }}</x-table.th>
                </x-table.tr>

            </x-slot:header>
            @foreach ($witnesses as $witness)
                <x-table.tr class="border-t">
                    <x-table.td>{{ $witness->id }}</x-table.td>
                    <x-table.td>{{ $witness->full_name }}</x-table.td>
                    <x-table.td>{{ $witness->active ? __('Yes') : __('No') }}</x-table.td>
                    <x-table.td>
                        <a href="{{ route('witness.edit', $witness->id) }}"
                            class="text-blue-600 hover:underline">{{ __('Edit') }}</a>
                        <form action="{{ route('witness.destroy', $witness->id) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                        </form>
                    </x-table.td>
                </x-table.tr>
            @endforeach
        </x-table>

        <div class="mt-4">
            {{ $witnesses->links() }}
        </div>
    </div>
</x-layout>
