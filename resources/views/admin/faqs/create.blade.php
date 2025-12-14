@extends('admin.layouts.app')

@php
    $title = 'Create FAQ';
    $subTitle = 'Add new FAQ';
@endphp

@section('content')
    <div class="card p-24">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-12 mb-20">
                    <label class="form-label">Question *</label>
                    <input type="text" name="question" class="form-control" value="{{ old('question') }}" required>
                </div>

                <div class="col-md-12 mb-20">
                    <label class="form-label">Answer *</label>
                    <textarea name="answer" class="form-control" rows="6" required>{{ old('answer') }}</textarea>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-24">
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
