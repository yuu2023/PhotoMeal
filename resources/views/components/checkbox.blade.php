@props(['checked' => false])

<input {{ $checked === 'true' ? 'checked' : '' }} {{ $attributes->merge(['type' => 'checkbox', 'class' => 'rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500']) }}  >
