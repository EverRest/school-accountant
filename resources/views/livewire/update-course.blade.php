<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <div class="card w-8/12 mx-12">
        <div class="card-body">
            <x-avatar :image="$course->photo" class="!w-24">
                <x-slot:title class="text-3xl pl-2">
                    {{ $course->name }}
                </x-slot:title>
                <x-slot:subtitle class="text-neutral flex flex-col gap-1 mt-2 pl-2">
                    <x-icon name="o-academic-cap" label="{{ $course->group->name?? '' }}"/>
                </x-slot:subtitle>
            </x-avatar>
            <x-form wire:submit.prevent="submit">
                <x-input wire:model="name" label="Name" type="name" class="form-control" id="name"
                         placeholder="Enter name"/>
                <x-file wire:model="avatar" label="Upload Photo" accept="image/png, image/jpeg"/>
                @if (session()->has('error'))
                    <x-alert icon="o-exclamation-triangle" class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                <x-slot:actions>
                    <x-button label="Update Course" class="btn-primary" type="submit" spinner="save"/>
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
