<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card>
                <x-slot name="header">
                    <h3>Course Details</h3>
                </x-slot>
                <x-slot:figure>
                    <div>
                        <div class="mb-3">
                            <strong>Name:</strong>
                            {{ $course->name }}
                        </div>
                        <div class="mb-3">
                            <strong>Creator:</strong>
                            {{ $course->creator?->name ?? '' }}
                        </div>
                    </div>
                </x-slot:figure>
                <x-slot:menu>
                    <x-button icon="o-share" class="btn-circle btn-sm"/>
                    <x-icon name="o-heart" class="cursor-pointer"/>
                </x-slot:menu>
                <x-slot:actions>
                    <x-button link="{{ route('courses.list') }}" label="Back to List" class="btn-success"/>
                    <x-button link="{{ route('courses.update', ['course' => $course]) }}" label="Update"
                              class="btn-warning"/>
                </x-slot:actions>
            </x-card>
        </div>
    </div>
</div>
