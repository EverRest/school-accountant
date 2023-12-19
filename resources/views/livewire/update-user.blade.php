<div>
    <form wire:submit.prevent="submit">
        <x-input
            wire:model="name"
            type="name"
            label="Name"
            placeholder="Input name"
            error="{{ $errors->first('email') }}"
        />

        <x-input
            wire:model="email"
            type="email"
            label="Email"
            placeholder="Enter email"
            error="{{ $errors->first('email') }}"
        />

        <x-input
            wire:model="phone_number"
            type="text"
            label="Phone Number"
            placeholder="Enter phone number"
            error="{{ $errors->first('phone_number') }}"
        />

        <x-button type="submit" label="Update User" />
    </form>

    @if (session()->has('message'))
        <x-alert type="success">
            {{ session('message') }}
        </x-alert>
    @endif
</div>
