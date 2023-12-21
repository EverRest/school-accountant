<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <div class="card w-8/12 mx-12">
        <div class="card-body">
            <x-form wire:submit.prevent="submit">
                <x-input wire:model="name" type="name" class="form-control" id="name" placeholder="Enter name"/>
                <x-select label="Select Group" icon="o-users" :options="$groups" wire:model="group_id" inline/>
                <x-select label="Select Teacher" icon="o-user-circle" :options="$teachers" wire:model="teacher_id"
                          inline/>
                <x-datetime label="Date + Time" wire:model="date" icon="o-calendar" type="datetime-local"/>
                @if (session()->has('error'))
                    <x-alert icon="o-exclamation-triangle" class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                <x-slot:actions>
                    <x-button label="Create Lesson" class="btn-primary" type="submit" spinner="save"/>
                </x-slot:actions>
            </x-form>
        </div>
    </div>
</div>
