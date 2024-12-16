@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm/6 font-medium text-slate-50']) }}>
    {{ $value ?? $slot }}
</label>
