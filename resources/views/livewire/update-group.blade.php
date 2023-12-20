<div>
    <form wire:submit.prevent="submit">
        <x-input
            wire:model="name"
            type="name"
            label="Name"
            placeholder="Input name"
            error="{{ $errors->first('name') }}"
        />
        <x-select label="Select Course" icon="o-pencil" option-value="id" :options="$courses" wire:model="selectedCourse" inline/>
        <x-button type="submit" label="Update Course"/>
    </form>

    @if (session()->has('message'))
        <x-alert type="success">
            {{ session('message') }}
        </x-alert>
    @endif
</div>
