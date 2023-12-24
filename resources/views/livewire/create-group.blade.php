<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <div class="card w-8/12 mx-12">
        <div class="card-body">
            <x-form wire:submit.prevent="submit">
                <x-input wire:model="name" label="Name" type="name" class="form-control" id="name"
                         placeholder="Enter name"/>
                <x-select wire:model="selectedCourse" label="Select Courses" icon="o-pencil" :options="$courses"
                          inline/>
                <x-choices wire:model="selectedStudents" icon="o-users" hint="Add student to the course" label="Students" :options="$students" />
{{--                <x-choices wire:model="selectedTeachers" icon="o-user-circle" hint="Add teacher to the course" label="Teachers" :options="$teachers" />--}}
                @if (session()->has('error'))
                    <x-alert icon="o-exclamation-triangle" class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                <x-slot:actions>
                    <x-button label="Create Group" class="btn-primary" type="submit" spinner="save"/>
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
