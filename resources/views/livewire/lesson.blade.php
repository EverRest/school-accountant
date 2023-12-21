<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card>
                <x-slot name="header">
                    <h3>Lesson Details</h3>
                </x-slot>
                <x-slot:figure>
                    <div>
                        <div class="mb-3">
                            <strong>Creator:</strong>
                            {{ $lesson->creator?->name ?? '' }}
                        </div>
                        <div class="mb-3">
                            <strong>Group:</strong>
                            {{ $lesson->group?->name ?? '' }}
                        </div>
                        <div class="mb-3">
                            <strong>Teacher:</strong>
                            {{ $lesson->teacher->user?->name ?? '' }}
                        </div>
                        <div class="mb-3">
                            <strong>Date:</strong>
                            {{ $lesson->date }}
                        </div>
                    </div>
                </x-slot:figure>
                <x-slot:menu>
                    <x-button icon="o-share" class="btn-circle btn-sm"/>
                    <x-icon name="o-heart" class="cursor-pointer"/>
                </x-slot:menu>
                <x-slot:actions>
                    <x-button link="{{ route('lessons.list') }}" label="Back to List" class="btn-success"/>
                    <x-button link="{{ route('lessons.update', ['lesson' => $lesson]) }}" label="Update Lesson"
                              class="btn-warning"/>
                </x-slot:actions>
            </x-card>
        </div>
    </div>
</div>
