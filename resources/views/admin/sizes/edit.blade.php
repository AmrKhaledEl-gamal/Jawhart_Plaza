@extends('admin.layouts.app')

@php
    $title = 'Edit Size';
    $subTitle = 'Update size';
@endphp

@section('content')
    <div class="card p-24">
        <form action="{{ route('admin.sizes.update', $size) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-20">
                <label class="form-label">Size Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $size->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.sizes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
