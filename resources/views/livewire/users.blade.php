<div>
    <x-header title="Teachers" subtitle="Check this on mobile">
        <x-slot:middle class="!justify-end">
            <x-input wire:model="search" icon="o-magnifying-glass" placeholder="Search..."/>
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel" class="btn-primary" wire:click="searchQ"/>
            <x-button icon="o-plus" class="btn-primary" wire:click="create"/>
        </x-slot:actions>
    </x-header>

    <x-table :headers="$headers" :rows="$users">
        @scope('cell_id', $user)
        <strong>{{ $user->id }}</strong>
        @endscope

        @scope('cell_name', $stuff)
        <x-badge :value="$stuff->name" class="badge-info"/>
        @endscope

        @scope('cell_phone_number', $user)
        <i>{{ $user->phone_number }}</i>
        @endscope

        @scope('cell_email', $user)
        <i>{{ $user->email }}</i>
        @endscope

        @scope('actions', $user)
        <div class="d-flex align-items-center">
            <x-dropdown>
                <x-menu-item title="Edit" wire:click="edit({{ $user->id }})" icon="o-pencil" spinner class="btn-sm"/>
                <x-menu-item title="Remove" wire:click="delete({{ $user->id }})" icon="o-trash" spinner class="btn-sm"/>
            </x-dropdown>
        </div>
        @endscope

    </x-table>
</div>
