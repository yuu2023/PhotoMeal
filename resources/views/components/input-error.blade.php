@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'c-input-error']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
