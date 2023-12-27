<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <div class="card w-8/12 mx-12">
        <div class="card-body">
            <x-form wire:submit.prevent="submit">
                <x-input wire:model="name" label="Theme" type="name" class="form-control" id="name"
                         placeholder="Enter theme"/>
                <x-select label="Select Group"
                          icon="o-users"
                          :options="$groups"
                          wire:model="group_id"
                          placeholder="Select Group"
                          inline
                />
                <x-select
                    label="Select Teacher"
                    icon="o-user-circle"
                    :options="$teachers"
                    wire:model="teacher_id"
                    placeholder="Select Teacher"
                    inline
                />
                <x-datetime label="Choose the date of the lesson"
                            wire:model="date"
                            icon="o-calendar"
                            type="datetime-local"/>
                <x-file wire:model="avatar" label="Upload Photo" accept="image/png, image/jpeg" />
                @if (session()->has('error'))
                    <x-alert icon="o-exclamation-triangle" class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                <x-slot:actions>
                    <x-button label="Create Lesson" class="btn-primary" type="submit" spinner="save"/>
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
