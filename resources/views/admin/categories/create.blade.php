@extends('admin.layouts.app')
@php
    $title = 'Create Category';
    $subTitle = 'Add New Category';
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
                            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    {{-- name --}}
                                    <div class="col-md-6 mb-20">
                                        <label for="name_ar"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Name (Arabic) <span class="text-danger-600">*</span>
                                        </label>
                                        <input type="text" name="name[ar]" id="name_ar"
                                            class="form-control radius-8 @error('name.ar') is-invalid @enderror"
                                            value="{{ old('name.ar') }}" placeholder="الاسم بالعربية">
                                        @error('name.ar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-20">
                                        <label for="name_en"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Name (English) <span class="text-danger-600">*</span>
                                        </label>
                                        <input type="text" name="name[en]" id="name_en"
                                            class="form-control radius-8 @error('name.en') is-invalid @enderror"
                                            value="{{ old('name.en') }}" placeholder="Name in English">
                                        @error('name.en')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- slug --}}
                                    <div class="col-md-6 mb-20">
                                        <label for="slug"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Slug <span class="text-danger-600">*</span>
                                        </label>
                                        <input type="text" name="slug" id="slug"
                                            class="form-control radius-8 @error('slug') is-invalid @enderror"
                                            value="{{ old('slug') }}" placeholder="Enter Slug">
                                        @error('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- parent_id --}}
                                    <div class="col-md-6 mb-20">
                                        <label for="parent_id"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Parent Category
                                        </label>
                                        <select name="parent_id" id="parent_id"
                                            class="form-control radius-8 form-select @error('parent_id') is-invalid @enderror">
                                            <option value="">Select Parent Category (Optional)</option>
                                            @foreach ($parents as $parent)
                                                <option value="{{ $parent->id }}"
                                                    {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                                    {{ $parent->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- is_active --}}
                                    <div class="col-md-12 mb-20">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                                name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>

                                    {{-- Upload Image --}}
                                    <div class="col-md-12 mb-20">
                                        <div class="card h-100 p-0">
                                            <div class="card-header border-bottom bg-base py-16 px-24">
                                                <h6 class="text-lg fw-semibold mb-0">Upload Image</h6>
                                            </div>
                                            <div class="card-body p-24">
                                                <div class="upload-image-wrapper d-flex align-items-center gap-3">
                                                    <div
                                                        class="uploaded-img d-none position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                                        <button type="button"
                                                            class="uploaded-img__remove position-absolute top-0 end-0 z-1 text-2xxl line-height-1 me-8 mt-8 d-flex">
                                                            <iconify-icon icon="radix-icons:cross-2"
                                                                class="text-xl text-danger-600"></iconify-icon>
                                                        </button>
                                                        <img id="uploaded-img__preview" class="w-100 h-100 object-fit-cover"
                                                            src="" alt="image">
                                                    </div>
                                                    <label
                                                        class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1"
                                                        for="upload-file">
                                                        <iconify-icon icon="solar:camera-outline"
                                                            class="text-xl text-secondary-light"></iconify-icon>
                                                        <span class="fw-semibold text-secondary-light">Upload</span>
                                                        <input id="upload-file" type="file" hidden name="image">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Buttons --}}
                                    <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                                        <a href="{{ route('admin.categories.index') }}"
                                            class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 text-decoration-none">
                                            Cancel
                                        </a>
                                        <button type="submit"
                                            class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                            Save
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
