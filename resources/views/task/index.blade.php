<x-layout>
    <x-slot:title>{{$date}}</x-slot:title>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow">

        <div>
            <a href="{{ route('task.index', [$year, $week-1]) }}" aria-label="попередній тиждень"><<</a>
            <strong>{{ $date }}</strong>
            <a href="{{ route('task.index', [$year, $week+1]) }}" aria-label="наступний тиждень">
                >>
            </a>
        </div>
        <table>
            @foreach ($tasks as $task)
                <tr>
                    <td  class="border border-gray-300 p-2">{{$task['label']}}</td>
                    @isset($task['witness'])
                        <td  class="border border-gray-300 p-2">{{$task['witness']}}</td>
                    @endisset

                </tr>
            @endforeach
        </table>
    </div>

</x-layout>
