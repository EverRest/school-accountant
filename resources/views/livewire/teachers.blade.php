<div>
    <x-header title="Teachers" subtitle="Check this on mobile">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-magnifying-glass" placeholder="Search..."/>
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel"/>
            <x-button icon="o-plus" class="btn-primary"/>
        </x-slot:actions>
    </x-header>
    @php
        $users = App\Models\User::select('id','name','email','phone_number',)->paginate(3);

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'phone_number', 'label' => 'Phone Number'],
        ];
    @endphp

    <x-table :headers="$headers" :rows="$users" with-pagination>
        @scope('cell_id', $user)
        <strong>{{ $user->id }}</strong>
        @endscope

        {{-- You can name the injected object as you wish  --}}
        @scope('cell_name', $stuff)
        <x-badge :value="$stuff->name" class="badge-info"/>
        @endscope

        {{-- Notice the `dot` notation for nested attribute cell's slot --}}
        @scope('cell_phone_number', $user)
        <i>{{ $user->phone_number }}</i>
        @endscope

        @scope('cell_email', $user)
        <i>{{ $user->email }}</i>
        @endscope
        {{--        @scope('cell_city.name', $user)--}}
        {{--        <i>{{ $user->city->name }}</i>--}}
        {{--        @endscope--}}

        {{-- The `fakeColumn` does not exist to the actual object --}}
        {{--    @scope('cell_fakeColumn', $user)--}}
        {{--    <u>{{ $user->city->name }}</u>--}}
        {{--    @endscope--}}

        @scope('actions', $user)
        <x-button icon="o-trash" wire:click="delete({{ $user->id }})" spinner class="btn-sm"/>
        @endscope

    </x-table>
</div>
