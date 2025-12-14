@extends('admin.layouts.app')

@php
    $title = 'Edit FAQ';
    $subTitle = 'Update FAQ';
@endphp

@section('content')
    <div class="card p-24">
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12 mb-20">
                    <label class="form-label">Question *</label>
                    <input type="text" name="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
                </div>

                <div class="col-md-12 mb-20">
                    <label class="form-label">Answer *</label>
                    <textarea name="answer" class="form-control" rows="6" required>{{ old('answer', $faq->answer) }}</textarea>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-24">
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
