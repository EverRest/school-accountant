<div class="d-flex justify-content-center align-items-center vh-300 pt-2.5">
    <div class="card w-8/12 mx-12">
        <div class="card-body">
            <x-avatar :image="$user->photo" class="!w-24">
                <x-slot:title class="text-3xl pl-2">
                    {{ $user->name }}
                </x-slot:title>
                <x-slot:subtitle class="text-neutral flex flex-col gap-1 mt-2 pl-2">
                    <x-icon name="o-academic-cap" label="{{ $user->email ?? '' }}"/>
                </x-slot:subtitle>
            </x-avatar>
            <x-form wire:submit.prevent="submit">
                <x-input wire:model="name" label="Name" type="name" class="form-control" id="name"
                         placeholder="Enter name"/>
                <x-input wire:model="email" label="Email" type="email" class="form-control" id="email"
                         placeholder="Enter email"/>
                <x-input wire:model="parent" label="Parent Name"
                         type="parent" class="form-control" id="parent"
                         placeholder="Enter Parent Name"/>
                <x-input wire:model="phone_number" label="Phone Number" type="text" class="form-control"
                         id="phone_number"
                         placeholder="Enter Phone Number"/>
                <x-file wire:model="avatar" label="Upload Photo" accept="image/png, image/jpeg" />
                @if($packages->isNotEmpty())
                    <x-choices wire:model="package_id"
                               icon="o-users"
                               hint="Buy package"
                               label="Packages"
                               :options="$packages"
                               single
                    />
                @else
                    <div class="text-center">
                        <x-button label="Add package" icon="o-currency-dollar" class="btn-accent btn-sm w-1/3"
                                  link="{{route('packages.create')}}"/>
                    </div>
                @endif
                @if (session()->has('error'))
                    <x-alert icon="o-exclamation-triangle" class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif
                <x-slot:actions>
                    <x-button label="Update User" class="btn-primary" type="submit" spinner="save"/>
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

