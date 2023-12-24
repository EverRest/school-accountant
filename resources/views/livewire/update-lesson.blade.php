<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <div class="card w-8/12 mx-12">
        <div class="card-body">
            <x-form wire:submit.prevent="submit">
                <x-input wire:model="name" label="Theme" type="name" class="form-control" id="name" placeholder="Enter theme"/>
                <x-select label="Select Group" icon="o-users" option-value="id" :options="$groups"
                          wire:model="selectedGroup" inline/>
                <x-select label="Select Teacher" icon="o-user-circle" option-value="id" :options="$users"
                          wire:model="selectedUser" inline/>
                @if (session()->has('error'))
                    <x-alert icon="o-exclamation-triangle" class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                <x-slot:actions>
                    <x-button label="Update Lesson" class="btn-primary" type="submit" spinner="save"/>
                </x-slot:actions>
            </x-form>
            @if (session()->has('message'))
                <x-alert type="success">
                    {{ session('message') }}
                </x-alert>
            @endif
        </div>
    </div>
</div>

