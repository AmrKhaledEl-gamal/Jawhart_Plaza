@extends('admin.layouts.app')

@php
    $title = 'Colors';
    $subTitle = 'Manage Colors';
@endphp

@section('content')
    <div class="card p-24">
        <div class="d-flex justify-content-between align-items-center mb-24">
            <h5>Colors</h5>
            <a href="{{ route('admin.colors.create') }}" class="btn btn-primary">Add Color</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($colors as $color)
                    <tr>
                        <td>{{ $color->name }}</td>
                        <td>{{ $color->code }}</td>
                        <td>
                            <a href="{{ route('admin.colors.edit', $color) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.colors.destroy', $color) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this color?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $colors->links() }}
    </div>
@endsection
