<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <div class="card w-8/12 mx-12">
        <div class="card-body">
            <x-avatar :image="$group->photo" class="!w-24">
                <x-slot:title class="text-3xl pl-2">
                    {{ $group->name }}
                </x-slot:title>
                <x-slot:subtitle class="text-neutral flex flex-col gap-1 mt-2 pl-2">
                    <x-icon name="o-academic-cap" label="{{ $group->teachers()?->first()?->name?? '' }}"/>
                </x-slot:subtitle>
            </x-avatar>
            <x-form wire:submit.prevent="submit">
                <x-input wire:model="name" label="Name" type="name" class="form-control" id="name"
                         placeholder="Enter name"/>
                <x-select label="Select Course" label="Course" icon="o-pencil" option-value="id" :options="$courses"
                          wire:model="selectedCourse" inline/>
                <x-choices wire:model="selectedStudents"
                           debounce="200ms"
                           icon="o-users"
                           hint="Add student to the group"
                           label="Students"
                           :options="$students"
                />
                <x-choices wire:model="selectedTeachers"
                           debounce="200ms"
                           icon="o-user-circle"
                           hint="Add teacher to the group"
                           label="Teachers"
                           :options="$teachers"
                />
                <x-file wire:model="avatar" label="Upload Photo" accept="image/png, image/jpeg" />
                @if (session()->has('error'))
                    <x-alert icon="o-exclamation-triangle" class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                <x-slot:actions>
                    <x-button label="Update Group" class="btn-primary" type="submit" spinner="save"/>
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

