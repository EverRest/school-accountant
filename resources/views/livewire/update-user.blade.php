<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <div class="card w-8/12 mx-12">
        <div class="card-body">
            <x-form wire:submit.prevent="submit">
                <x-input wire:model="name" type="name" class="form-control" id="name" placeholder="Enter name"/>
                <x-input wire:model="email" type="email" class="form-control" id="email"
                         placeholder="Enter email"/>
                <x-input wire:model="price" type="price" class="form-control" id="price" placeholder="Enter price"/>
                <x-input wire:model="phone_number" type="text" class="form-control" id="phone_number" placeholder="Enter Phone Number"/>
                @if (session()->has('error'))
                    <x-alert icon="o-exclamation-triangle" class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                <x-slot:actions>
                    <x-button label="Update User" class="btn-primary" type="submit" spinner="save"/>
                </x-slot:actions>
            </x-form>
        </div>
    </div>
</div>

