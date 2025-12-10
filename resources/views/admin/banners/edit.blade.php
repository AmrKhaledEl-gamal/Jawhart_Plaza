@extends('admin.layouts.app')

@php
    $title = 'Edit Banner';
    $subTitle = 'Update Banner';
@endphp

@section('content')
    <div class="card p-4">
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">الرابط</label>
                <input type="text" name="link" class="form-control" value="{{ $banner->link }}">
            </div>

            <div class="mb-3">
                <label class="form-label">الصورة الحالية</label><br>
                <img src="{{ $banner->getFirstMediaUrl('banner_image') }}" width="120" class="rounded mb-2">
            </div>

            <div class="mb-3">
                <label class="form-label">تغير الصورة</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button class="btn btn-success">تحديث</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
