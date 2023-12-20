@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Assuming 'x-mary-card' is a card component from mary-ui -->
                <x-mary-card>
                    <x-slot name="header">
                        <h3>Item Details</h3>
                    </x-slot>

                    <x-mary-card-body>
                        <div class="mb-3">
                            <strong>Name:</strong>
                            {{ $item->name }}
                        </div>
                        <div class="mb-3">
                            <strong>Description:</strong>
                            {{ $item->description }}
                        </div>
                        <!-- Add more fields as needed -->
                    </x-mary-card-body>

                    <x-mary-card-footer>
                        <a href="{{ route('items.index') }}" class="btn btn-primary">
                            Back to List
                        </a>
                    </x-mary-card-footer>
                </x-mary-card>
            </div>
        </div>
    </div>
@endsection
