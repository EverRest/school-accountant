<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased">
<x-main full-width>
    <x-slot:sidebar drawer="main-drawer" collapsible class="pt-3 bg-sky-800 text-white">
        <div class="hidden-when-collapsed ml-5 font-black text-4xl text-yellow-500">Accountant</div>
        <div class="display-when-collapsed ml-5 font-black text-4xl text-orange-500">
            <x-icon name="o-banknotes"/>
        </div>
        <x-menu activate-by-route active-bg-color="bg-base-300/10">
            @if($user = auth()->user())
                <x-list-item :item="$user" sub-value="username" no-separator no-hover
                             class="!-mx-2 mt-2 mb-5 border-y border-y-sky-900">
                    <x-slot:actions>
                        <x-button wire:click="logout" link="/log-out" icon="o-power" class="btn-circle btn-ghost btn-xs"
                                  tooltip-left="logoff"/>
                    </x-slot:actions>
                </x-list-item>
                <x-menu-sub title="Users" icon="o-users">
                    <x-menu-item title="Administrators" icon="o-user-circle" link="/administrators"/>
                    <x-menu-item title="Teachers" icon="o-users" link="/teachers"/>
                    <x-menu-item title="Students" icon="o-user-group" link="/students"/>
                </x-menu-sub>
                <x-menu-item title="Courses" icon="o-pencil-square" link="/courses"/>
                <x-menu-item title="Groups" icon="o-rectangle-group" link="/groups"/>
                <x-menu-item title="Packages" icon="o-circle-stack" link="/packages"/>
                <x-menu-sub title="Payments" icon="o-chart-pie">
                    <x-menu-item title="Income" icon="o-arrow-down-tray" link="/income"/>
                    <x-menu-item title="Outcome" icon="o-arrow-up-tray" link="/outcome"/>
                    <x-menu-item title="Reports" icon="o-chart-bar-square" link="/reports"/>
                </x-menu-sub>
                <x-menu-sub title="Attendee" icon="o-chart-pie">
                    <x-menu-item title="Administrators" icon="o-user-circle" link="####"/>
                    <x-menu-item title="Teachers" icoaddedn="o-users" link="####"/>
                    <x-menu-item title="Students" icon="o-user-group" link="####"/>
                </x-menu-sub>
{{--                <x-menu-sub title="Reports" icon="o-clipboard-document-check">--}}
{{--                    <x-menu-item title="Wifi" icon="o-wifi" link="####"/>--}}
{{--                    <x-menu-item title="Archives" icon="o-archive-box" link="####"/>--}}
{{--                </x-menu-sub>--}}
{{--                <x-menu-sub title="Settings" icon="o-cog-6-tooth">--}}
{{--                    <x-menu-item title="Wifi" icon="o-wifi" link="####"/>--}}
{{--                    <x-menu-item title="Archives" icon="o-archive-box" link="####"/>--}}
{{--                </x-menu-sub>--}}
            @else
                <x-menu-item title="Login" icon="o-user-plus" link="/login"/>
            @endif
            <x-menu-item title="Home" icon="o-home" link="/"/>
        </x-menu>
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}
    <x-slot:content>
        {{ $slot }}
    </x-slot:content>
</x-main>
</body>
</html>
