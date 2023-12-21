<div>
    <x-header title="Lessons" subtitle="List of lessons">
        <x-slot:middle class="!justify-end">
            <x-input wire:model="search" icon="o-magnifying-glass" placeholder="Search..."/>
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel" class="btn-primary" wire:click="searchQ"/>
            <x-button icon="o-plus" class="btn-primary" link="{{route('lessons.create')}}"/>
        </x-slot:actions>
    </x-header>

    <x-table :headers="$headers" :rows="$lessons">
        @scope('cell_id', $lesson)
        <strong>{{ $lesson->id }}</strong>
        @endscope

        @scope('cell_name', $lesson)
        <x-badge :value="$lesson->name" class="badge-info"/>
        @endscope

        @scope('cell_course', $lesson)
        <x-badge :value="$lesson?->course?->name"/>
        @endscope

        @scope('cell_creator', $lesson)
        <x-badge :value="$lesson?->creator?->name??''"/>
        @endscope

        @scope('actions', $lesson)
        <div class="d-flex align-items-center">
            <x-dropdown>
                <x-menu-item title="View" link="{{route('lessons.show', ['lesson' => $lesson])}}" icon="o-eye" spinner
                             class="btn-sm"/>
                <x-menu-item title="Edit" link="{{route('lessons.update', ['lesson' => $lesson])}}" icon="o-pencil" spinner
                             class="btn-sm"/>
                <x-menu-item title="Remove" wire:click="delete({{ $lesson->id }})" icon="o-trash" spinner
                             class="btn-sm"/>
            </x-dropdown>
        </div>
        @endscope

    </x-table>
</div>