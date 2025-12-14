@extends('admin.layouts.app')

@php
    $title = 'Edit Color';
    $subTitle = 'Update color';
@endphp

@section('content')
    <div class="card p-24">
        <form action="{{ route('admin.colors.update', $color) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-20">
                <label class="form-label">Color Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $color->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-20">
                <label class="form-label">Color Code (optional)</label>
                <input type="text" name="code" class="form-control" value="{{ old('code', $color->code) }}">
                @error('code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
