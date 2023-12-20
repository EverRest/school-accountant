<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card>
                <x-slot name="header">
                    <h3>User Details</h3>
                </x-slot>

                <x-slot:figure>
                    <div>
                        <div class="mb-3">
                            <strong>Name:</strong>
                            {{ $user->name }}
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>
                        <div class="mb-3">
                            <strong>Phone number:</strong>
                            {{ $user->phone_number }}
                        </div>
                        <div class="mb-3">
                            <strong>Role:</strong>
                            {{ $role }}
                        </div>
                    </div>
                </x-slot:figure>
                <x-slot:menu>
                    <x-button icon="o-share" class="btn-circle btn-sm"/>
                    <x-icon name="o-heart" class="cursor-pointer"/>
                </x-slot:menu>
                <x-slot:actions>
                    <x-button link="{{ $backUrl }}" label="Back to List" class="btn-success"/>
                    <x-button link="{{ route('users.update', ['user' => $user]) }}" label="Update"
                              class="btn-warning"/>
                </x-slot:actions>
            </x-card>
        </div>
    </div>
</div>
