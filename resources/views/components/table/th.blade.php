@props(['orderBy' => false])
<th {{ $attributes->merge(['class' => 'p-2 ' . ($orderBy ? 'text-blue-700 ' : '')]) }}>
    @if ($orderBy)
        <a
            href="
        {{ route(
            Route::currentRouteName(),
            array_merge(request()->query(), [
                'orderBy' => $orderBy,
                'orderDir' => request()->get('orderDir') == 'DESC' || request()->get('orderBy') != $orderBy ? 'ASC' : 'DESC',
            ]),
        ) }}
        ">
            {{ $slot }}
        </a>
    @else
        {{ $slot }}
    @endif

</th>
