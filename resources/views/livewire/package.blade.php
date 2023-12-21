<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card>
                <x-slot name="header">
                    <h3>Package Details</h3>
                </x-slot>
                <x-slot:figure>
                    <div>
                        <div class="mb-3">
                            <strong>Name:</strong>
                            {{ $package->name }}
                        </div>
                        <div class="mb-3">
                            <strong>Creator:</strong>
                            {{ $package->creator?->name ?? '' }}
                        </div>
                        <div class="mb-3">
                            <strong>Lessons:</strong>
                            {{ $package->cout_lessons }}
                        </div>
                        <div class="mb-3">
                            <strong>Price:</strong>
                            {{ $package->price }}
                        </div>
                    </div>
                </x-slot:figure>
                <x-slot:menu>
                    <x-button icon="o-share" class="btn-circle btn-sm"/>
                    <x-icon name="o-heart" class="cursor-pointer"/>
                </x-slot:menu>
                <x-slot:actions>
                    <x-button link="{{ route('packages.list') }}" label="Back to List" class="btn-success"/>
                    <x-button link="{{ route('packages.update', ['package' => $package]) }}" label="Update Package"
                              class="btn-info"/>
                </x-slot:actions>
            </x-card>
        </div>
    </div>
</div>
