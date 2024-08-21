<label class="{{ $class }}" for="{{ $for ? $for:$name }}">
    {{ __($name) }}

    @if ($required)
        <span class="form-label-required form-label text-danger">*</span>
    @endif

    {{ $slot }}
</label>
