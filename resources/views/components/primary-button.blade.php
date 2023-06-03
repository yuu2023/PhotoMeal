<button {{ $attributes->merge(['type' => 'button', 'class' => 'c-primary-button']) }} >
    {{ $slot }}
</button>
