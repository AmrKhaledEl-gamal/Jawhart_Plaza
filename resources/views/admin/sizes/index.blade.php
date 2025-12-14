@extends('admin.layouts.app')

@php
    $title = 'Sizes';
    $subTitle = 'Manage Sizes';
@endphp

@section('content')
    <div class="card p-24">
        <div class="d-flex justify-content-between align-items-center mb-24">
            <h5>Sizes</h5>
            <a href="{{ route('admin.sizes.create') }}" class="btn btn-primary">Add Size</a>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sizes as $size)
                    <tr>
                        <td>{{ $size->name }}</td>
                        <td>
                            <a href="{{ route('admin.sizes.edit', $size) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.sizes.destroy', $size) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this size?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $sizes->links() }}
    </div>
@endsection
