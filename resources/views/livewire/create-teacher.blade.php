<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <div class="card w-8/12 mx-12">
        <div class="card-body">
            <x-form wire:submit.prevent="submit">
                <x-input wire:model="name" type="name" class="form-control" id="name" placeholder="Enter name"/>
                <x-input wire:model="email" type="email" class="form-control" id="email" placeholder="Enter email"/>
                <x-input wire:model="password" type="password" class="form-control" id="password"
                         placeholder="Enter password"/>
                <x-input wire:model="individual_lesson_salary" type="text" class="form-control" id="individual_lesson_salary"
                         placeholder="Enter individual lesson salary"/>
                <x-input wire:model="group_lesson_salary" type="text" class="form-control" id="group_lesson_salary"
                         placeholder="Enter group lesson salary"/>
                <x-input wire:model="phone_number" type="text" class="form-control" id="phone_number"
                         placeholder="Enter phone number"/>
                @if (session()->has('error'))
                    <x-alert icon="o-exclamation-triangle" class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                <x-slot:actions>
                    <x-button label="Create User" class="btn-primary" type="submit" spinner="save"/>
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
