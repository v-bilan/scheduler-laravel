@props(['name' => 'name', 'submit' => 'Filter'])
@php
    $query = request()->query();
    unset($query['filter[' . $name . ']']);
@endphp
<form class="mr-4" action="{{ route(Route::currentRouteName(), $query) }}">
    <input class=" p-2 border rounded-lg" name="filter[{{ $name }}]" value="{{ request('filter.' . $name) }}" />
    <input type="submit" value="{{ __($submit) }}"
        class="mb-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700" />
</form>
