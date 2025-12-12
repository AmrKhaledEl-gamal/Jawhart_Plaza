@extends('admin.layouts.app')
@php
    $title = 'Edit Blog';
    $subTitle = 'Update Blog';
    $script = '
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        const fileInput = document.getElementById("upload-file");
        const imagePreview = document.getElementById("uploaded-img__preview");
        const uploadedImgContainer = document.querySelector(".uploaded-img");
        const removeButton = document.querySelector(".uploaded-img__remove");

        fileInput.addEventListener("change", (e) => {
            if (e.target.files.length) {
                const src = URL.createObjectURL(e.target.files[0]);
                imagePreview.src = src;
                uploadedImgContainer.classList.remove("d-none");
            }
        });

        removeButton.addEventListener("click", () => {
            imagePreview.src = "";
            uploadedImgContainer.classList.add("d-none");
            fileInput.value = "";
        });

        ClassicEditor.create(document.querySelector("#body")).catch(error => {
            console.error(error);
        });
    </script>';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-12 col-xl-8 col-lg-10">
                    <div class="card border">
                        <div class="card-body">
                            <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    {{-- name --}}
                                    <div class="col-md-12 mb-20">
                                        <label for="name"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            اسم الوظيفة <span class="text-danger-600">*</span>
                                        </label>
                                        <input type="text" name="name" id="name"
                                            class="form-control radius-8 @error('name') is-invalid @enderror"
                                            value="{{ old('name', $job->name) }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- description --}}
                                    <div class="col-md-12 mb-20">
                                        <label for="description"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            وصف الوظيفة <span class="text-danger-600">*</span>
                                        </label>
                                        <input type="text" name="description" id="description"
                                            class="form-control radius-8 @error('description') is-invalid @enderror"
                                            value="{{ old('description', $job->description) }}">
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    {{-- Buttons --}}
                                    <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                                        <a href="{{ route('admin.jobs.index') }}"
                                            class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 text-decoration-none">
                                            إلغاء
                                        </a>
                                        <button type="submit"
                                            class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                            حفظ التغييرات
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
