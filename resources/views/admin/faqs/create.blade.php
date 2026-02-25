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
                <div class="col-md-6 mb-20">
                    <label class="form-label">Question (Arabic) *</label>
                    <input type="text" name="question[ar]" class="form-control @error('question.ar') is-invalid @enderror"
                        value="{{ old('question.ar') }}" required>
                    @error('question.ar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-20">
                    <label class="form-label">Question (English) *</label>
                    <input type="text" name="question[en]"
                        class="form-control @error('question.en') is-invalid @enderror" value="{{ old('question.en') }}"
                        required>
                    @error('question.en')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-20">
                    <label class="form-label">Answer (Arabic) *</label>
                    <textarea name="answer[ar]" class="form-control @error('answer.ar') is-invalid @enderror" rows="6" required>{{ old('answer.ar') }}</textarea>
                    @error('answer.ar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-20">
                    <label class="form-label">Answer (English) *</label>
                    <textarea name="answer[en]" class="form-control @error('answer.en') is-invalid @enderror" rows="6" required>{{ old('answer.en') }}</textarea>
                    @error('answer.en')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-center gap-3 mt-24">
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
