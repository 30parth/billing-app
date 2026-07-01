@props([
    'id' => '',
    'name' => '',
    'attributes' => [],
])

@php
    $option = [['id' => 'feet', 'name' => 'Feet'], ['id' => 'inch', 'name' => 'Inch']];
@endphp

<x-ui.form.select-with-label :id="$id" :name="$name" no-label :options="$option" valueLabel="name"
    value="id" {{ $attributes }} />
