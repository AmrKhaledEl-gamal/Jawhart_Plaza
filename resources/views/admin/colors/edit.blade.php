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
                <div class="col-md-6 mb-20">
                    <label>Choose Color</label>
                    <input type="color" name="code" class="form-control form-control-color"
                        value="{{ $color->code ?? '#000000' }}" required style="padding:0">

                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
