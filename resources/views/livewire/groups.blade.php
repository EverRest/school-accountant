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

    <x-table :headers="$headers" :rows="$groups">
        @scope('cell_id', $group)
        <strong>{{ $group->id }}</strong>
        @endscope

        @scope('cell_name', $group)
        <x-badge :value="$group->name" class="badge-info"/>
        @endscope

        @scope('cell_course', $group)
        <x-badge :value="$group?->course?->name" />
        @endscope

        @scope('cell_creator', $group)
        <x-badge :value="$group?->creator?->name??''" />
        @endscope

        @scope('actions', $group)
        <div class="d-flex align-items-center">
            <x-dropdown>
                <x-menu-item title="Edit" wire:click="edit({{ $group->id }})" icon="o-pencil" spinner class="btn-sm"/>
                <x-menu-item title="Remove" wire:click="delete({{ $group->id }})" icon="o-trash" spinner class="btn-sm"/>
            </x-dropdown>
        </div>
        @endscope

    </x-table>
</div>
