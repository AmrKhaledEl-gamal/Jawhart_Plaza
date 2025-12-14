@extends('admin.layouts.app')

@php
    $title = isset($color) ? 'Edit Color' : 'Add Color';
@endphp

@section('content')
    <div class="card p-24">
        <form action="{{ isset($color) ? route('admin.colors.update', $color) : route('admin.colors.store') }}"
            method="POST">
            @csrf
            @if (isset($color))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6 mb-20">
                    <label>Choose Color</label>
                    <input type="color" name="code" class="form-control form-control-color"
                        value="{{ $color->code ?? '#000000' }}" required style="padding:0">
                </div>

                <div class="col-md-6 mb-20 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ isset($color) ? 'Update Color' : 'Add Color' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
