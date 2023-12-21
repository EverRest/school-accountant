<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <div class="card w-8/12 mx-12"> <!-- Adjust the width as necessary -->
        <div class="card-body">
            <x-form wire:submit.prevent="submit">
                <x-input wire:model="email" type="email" class="form-control" id="email" placeholder="Enter email"/>
                <x-input wire:model="password" type="password" class="form-control" id="password"
                         placeholder="Password"/>
                @if (session()->has('error'))
                    <x-alert icon="o-exclamation-triangle" class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                <x-slot:actions>
                    <x-button label="Cancel" wire:click="clear"/>
                    <x-button label="Login" class="btn-primary" type="submit" spinner="save"/>
                </x-slot:actions>
            </x-form>
        </div>
    </div>
</div>
