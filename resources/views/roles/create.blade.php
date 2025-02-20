<x-layout>
    <x-slot:title>Edit Role</x-slot:title>
    <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">{{ __('Create Role') }}</h2>
    
        <form action="{{ route('role.store') }}" method="POST">
            @csrf
    
            <label class="block mb-2 text-sm font-medium text-gray-700">{{ __('Role Name') }}</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   class="w-full p-2 border rounded-lg @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
    
            <label class="block mt-4 mb-2 text-sm font-medium text-gray-700">{{ __('Priority') }}</label>
            <input type="number" name="priority" value="{{ old('priority', 0) }}" 
                   class="w-full p-2 border rounded-lg @error('priority') border-red-500 @enderror">
            @error('priority')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
    
            <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                {{ __('Create') }}
            </button>
        </form>
    </div>
    
</x-layout>