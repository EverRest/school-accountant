<div>
    <x-header title="Groups" subtitle="List of packages">
        <x-slot:middle class="!justify-end">
            <x-input wire:model="search" icon="o-magnifying-glass" placeholder="Search..."/>
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel" class="btn-primary" wire:click="searchQ"/>
            <x-button icon="o-plus" class="btn-primary" link="{{route('packages.create')}}"/>
        </x-slot:actions>
    </x-header>

    <x-table :headers="$headers" :rows="$packages">
        @scope('cell_id', $package)
        <strong>{{ $package->id }}</strong>
        @endscope

        @scope('cell_name', $package)
        <x-badge :value="$package->name" class="badge-info"/>
        @endscope

        @scope('cell_count_lesson', $package)
        <x-badge :value="{{intval($package->count_lesson)}}"/>
        @endscope

        @scope('cell_creator', $package)
        <x-badge :value="{{floatval($package->price)}}"/>
        @endscope

        @scope('actions', $package)
        <div class="d-flex align-items-center">
            <x-dropdown>
                <x-menu-item title="View" link="{{route('packages.show', ['package' => $package])}}" icon="o-eye" spinner
                             class="btn-sm"/>
                <x-menu-item title="Edit" link="{{route('packages.update', ['package' => $package])}}" icon="o-pencil" spinner
                             class="btn-sm"/>
                <x-menu-item title="Remove" wire:click="delete({{ $package->id }})" icon="o-trash" spinner
                             class="btn-sm"/>
            </x-dropdown>
        </div>
        @endscope

    </x-table>
</div>
