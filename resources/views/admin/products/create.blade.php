@extends('admin.layouts.app')

@php
    $title = 'Create Product';
    $subTitle = 'Add New Product';
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

        ClassicEditor.create(document.querySelector("#description_ar")).catch(console.error);
        ClassicEditor.create(document.querySelector("#description_en")).catch(console.error);
    </script>';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    {{-- Name --}}
                    <div class="col-md-6 mb-20">
                        <label class="form-label">Name (AR) *</label>
                        <input type="text" name="name[ar]" class="form-control" value="{{ old('name.ar') }}">
                    </div>

                    <div class="col-md-6 mb-20">
                        <label class="form-label">Name (EN) *</label>
                        <input type="text" name="name[en]" class="form-control" value="{{ old('name.en') }}">
                    </div>

                    {{-- Slug --}}
                    <div class="col-md-6 mb-20">
                        <label class="form-label">Slug *</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6 mb-20">
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-select">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Price --}}
                    <div class="col-md-6 mb-20">
                        <label class="form-label">Base Price *</label>
                        <input type="number" step="0.01" name="price" class="form-control"
                            value="{{ old('price') }}">
                    </div>

                    {{-- Active --}}
                    <div class="col-md-6 mb-20 d-flex align-items-center">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="col-md-6 mb-20">
                        <label>Description (AR)</label>
                        <textarea id="description_ar" name="description[ar]" class="form-control">{{ old('description.ar') }}</textarea>
                    </div>

                    <div class="col-md-6 mb-20">
                        <label>Description (EN)</label>
                        <textarea id="description_en" name="description[en]" class="form-control">{{ old('description.en') }}</textarea>
                    </div>

                    {{-- Image --}}
                    <div class="col-md-12 mb-20">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-center gap-3 mt-24">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-danger">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Save & Continue
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
