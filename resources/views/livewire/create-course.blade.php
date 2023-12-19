<div>
    <form wire:submit.prevent="submit">
        <x-input
            wire:model="name"
            type="name"
            label="Name"
            placeholder="Input name"
            error="{{ $errors->first('name') }}"
        />
        <x-button type="submit" label="Create Course"/>
    </form>
    @if (session()->has('message'))
        <x-alert type="success">
            {{ session('message') }}
        </x-alert>
    @endif
</div>
