@extends('admin.layouts.app')

@php
    $title = 'Add Size';
    $subTitle = 'Create new size';
@endphp

@section('content')
    <div class="card p-24">
        <form action="{{ route('admin.sizes.store') }}" method="POST">
            @csrf
            <div class="mb-20">
                <label class="form-label">Size Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.sizes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
