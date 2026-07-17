@props([
    'id' => '',
    'name' => '',
    'attributes' => [],
])

<x-ui.form.select-with-label :id="$id" :name="$name" label="Product" :options="$taxRates" valueLabel="name"
    value="id" {{ $attributes }} />
