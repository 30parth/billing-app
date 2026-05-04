@props([
    'title' => 'card',
])
<div class="w-full bg-neutral-primary-soft p-6 border border-default rounded-base shadow-xs">
    <h5 class="text-xl font-semibold text-heading mb-6">{{ $title }}</h5>
    {{ $slot }}
</div>
