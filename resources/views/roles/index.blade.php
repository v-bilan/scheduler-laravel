<x-layout>
    <x-slot:title>Roles List</x-slot:title>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">{{ __('Roles List') }}</h2>
    
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
    
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2">{{ __('ID') }}</th>
                    <th class="border border-gray-300 p-2">{{ __('Role Name') }}</th>
                    <th class="border border-gray-300 p-2">{{ __('Priority') }}</th>
                    <th class="border border-gray-300 p-2">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr class="text-center">
                        <td class="border border-gray-300 p-2">{{ $role->id }}</td>
                        <td class="border border-gray-300 p-2">{{ $role->name }}</td>
                        <td class="border border-gray-300 p-2">{{ $role->priority }}</td>
                        <td class="border border-gray-300 p-2 space-x-2">
                            <a href="{{ route('role.edit', $role->id) }}" class="text-blue-600 hover:underline">{{ __('Edit') }}</a>
                            <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('{{ __('Are you sure?') }}')">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <div class="mt-4">
            {{ $roles->links() }}
        </div>
    
        <a href="{{ route('role.create') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
            {{ __('Create New Role') }}
        </a>
    </div>
    
</x-layout>