@props(['id', 'modalId' => 'defaultModal'])
<div class="inline-flex  justify-between">
    <div wire:click="edit({{ $id }})">
        <x-ui.icon.edit />
    </div>
    <div wire:click="delete({{ $id }})" wire:confirm="Are you want to delete this ?">
        <x-ui.icon.trash />
    </div>

</div>
