<x-layout>
    <x-slot:title>{{$date}}</x-slot:title>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow">

        <div class=" w-full bg-gray-200 rounded-lg">
            <a href="{{ route('task.create', [$year, $week-1]) }}" aria-label="попередній тиждень"><<</a>
            <strong>{{ $date }}</strong>
            <a href="{{ route('task.create', [$year, $week+1]) }}" aria-label="наступний тиждень">
                >>
            </a>
        </div>
        <form method="POST" action="{{route('task.store', [$year, $week])}}">
        @method('PUT')
        @csrf
        <table>
            @foreach ($tasks as $taskName => $task)

                <tr>
                    <td  class="border border-gray-300 p-2">{{$task['label']}}</td>
                    @isset($task['witness'])
                        <td  class="border border-gray-300 p-2">{{$task['witness']->full_name}}</td>
                    @endisset
                    <td>
                        <select name="witnesses[{{$taskName}}]" id="witnesses"
                            class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-200">
                            @foreach ($task['witnesses'] as $witness)
                                <option value="{{ $witness->witness_id }}"
                                    {{ $witness->witness_id == old('witnesses', $task['witness']->id ?? $task['suggested_witness']?->witness_id) ? 'selected' : '' }}>
                                    {{ $witness->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
        </table>
        <button type="submit" class="mt-4 w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
            {{ __('Update') }}
        </button>
        </form>
    </div>

</x-layout>
