<x-layout>
    <x-slot:title>Roles List</x-slot:title>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">{{ __('Roles List') }}</h2>


        <div>
            <a href="{{ route('role.create') }}"
                class="mb-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                {{ __('Create New Role') }}
            </a>
            <a href="{{ route('sync') }}"
                class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                {{ __('Synchonize') }}
            </a>
        </div>

        <x-table>
            <x-slot:header>
                <x-table.tr class="bg-gray-100">
                    <x-table.th orderBy="id">{{ __('ID') }}</x-table.th>
                    <x-table.th orderBy="name">{{ __('Role Name') }}</x-table.th>
                    <x-table.th orderBy="priority">{{ __('Priority') }}</x-table.th>
                    <x-table.th>{{ __('Actions') }}</x-table.th>
                </x-table.tr>
            </x-slot:header>

            @foreach ($roles as $role)
                <x-table.tr class="border-t">
                    <x-table.td>{{ $role->id }}</x-table.td>
                    <x-table.td>{{ $role->name }}</x-table.td>
                    <x-table.td>{{ $role->priority }}</x-table.td>
                    <x-table.td>
                        <a href="{{ route('role.edit', $role->id) }}"
                            class="text-blue-600 hover:underline">{{ __('Edit') }}</a>
                        <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline"
                                onclick="return confirm('{{ __('Are you sure?') }}')">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </x-table.td>
                </x-table.tr>
            @endforeach
        </x-table>

        <div class="mt-4">
            {{ $roles->links() }}
        </div>


    </div>

</x-layout>
