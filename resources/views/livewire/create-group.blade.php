<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <p class="card w-8/12 mx-12">
    <p class="card-body">
        <x-form wire:submit.prevent="submit">
            <x-input wire:model="name" label="Name" type="name" class="form-control" id="name"
                     placeholder="Enter name"/>
            <x-select
                label="Select Course"
                icon="o-pencil"
                :options="$courses"
                wire:model="selectedCourse"
                single/>
            <x-file wire:model="avatar" label="Upload Photo" accept="image/png, image/jpeg" />
            @if($students->isNotEmpty())
                <x-choices wire:model="selectedStudents" icon="o-users" hint="Add student to the course"
                           label="Students" :options="$students"/>
            @else
                <div class="text-center">
                    <x-button label="Add student" icon="o-users" class="btn-accent btn-sm w-1/3"
                              link="{{route('students.create')}}"/>
                </div>
            @endif
            @if($teachers->isNotEmpty())
                <x-select
                    label="Select Teacher"
                    icon="o-user-circle"
                    :options="$teachers"
                    wire:model="selectedTeacherId"
                    inline/>
            @else
                <div class="text-center">
                    <x-button label="Add teacher" icon="o-user-circle" class="btn-primary btn-sm w-1/3"
                              link="{{route('teachers.create')}}"/>
                </div>
            @endif
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
