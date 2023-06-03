<button {{ $attributes->merge(['type' => 'submit', 'class' => 'c-danger-button']) }}>
    {{ $slot }}
</button>
