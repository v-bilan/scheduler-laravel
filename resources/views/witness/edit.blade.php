<x-layout>
    <x-slot:title>Create Witness</x-slot:title>
    <div class="max-w-lg mx-auto p-6 bg-white rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4">{{ __('Edit Witness') }}</h2>

        <form action="{{ route('witness.update', $witness->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 font-medium" for="full_name">{{ __('Full Name') }}</label>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $witness->full_name) }}"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-200">
                @error('full_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium" for="active">{{ __('Active') }}</label>
                <select name="active" id="active" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-200">
                    <option value="1" {{ old('active', $witness->active) == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
                    <option value="0" {{ old('active', $witness->active) == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
                </select>
                @error('active')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-700">
                {{ __('Update') }}
            </button>
        </form>
    </div>
</x-layout>