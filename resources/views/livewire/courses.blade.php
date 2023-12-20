<div>
    <x-header title="Courses" subtitle="List of courses">
        <x-slot:middle class="!justify-end">
            <x-input wire:model="search" icon="o-magnifying-glass" placeholder="Search..."/>
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel" class="btn-primary" wire:click="searchQ"/>
            <x-button icon="o-plus" class="btn-primary" link="{{route('courses.create')}}"/>
        </x-slot:actions>
    </x-header>

    <x-table :headers="$headers" :rows="$courses">
        @scope('cell_id', $course)
        <strong>{{ $course->id }}</strong>
        @endscope

        @scope('cell_name', $course)
        <x-badge :value="$course->name" class="badge-info"/>
        @endscope

        @scope('cell_creator', $course)
        <x-badge :value="$course?->creator?->name"/>
        @endscope

        @scope('actions', $course)
        <div class="d-flex align-items-center">
            <x-dropdown>
                <x-menu-item title="View" link="{{route('courses.show', ['course' => $course])}}" icon="o-eye" spinner
                             class="btn-sm"/>
                <x-menu-item title="Edit" link="{{route('courses.update', ['course' => $course])}}" icon="o-pencil"
                             spinner class="btn-sm"/>
                <x-menu-item title="Remove" wire:click="delete({{ $course->id }})" icon="o-trash" spinner
                             class="btn-sm"/>
            </x-dropdown>
        </div>
        @endscope

    </x-table>
</div>
