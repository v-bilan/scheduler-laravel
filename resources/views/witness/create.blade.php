<x-layout>
    <x-slot:title>Create Witness</x-slot:title>
    <div class="max-w-lg mx-auto p-6 bg-white rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create Witness') }}</h2>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('witness.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-medium" for="full_name">{{ __('Full Name') }}</label>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-200">
                @error('full_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium" for="active">{{ __('Active') }}</label>
                <select name="active" id="active"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-200">
                    <option value="1" {{ old('active', 1) == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
                    <option value="0" {{ old('active', 1) == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
                </select>
                @error('active')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium" for="roles">{{ __('Roles') }}</label>
                <select name="roles[]" id="roles"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-200" multiple>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach

                </select>
                @error('roles')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                {{ __('Create') }}
            </button>
        </form>
    </div>
</x-layout>
