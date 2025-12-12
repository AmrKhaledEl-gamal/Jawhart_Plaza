@extends('admin.layouts.app')

@php
    $title = 'About Page';
    $subTitle = 'Edit About';
    $script = '
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    {{-- JS لتحديث الصورة أو حذفها --}}
<script>
    const fileInput = document.getElementById("upload-file");
    const imagePreview = document.getElementById("uploaded-img__preview");
    const uploadedImgContainer = document.querySelector(".uploaded-img");
    const removeButton = document.querySelector(".uploaded-img__remove");

    // رفع صورة جديدة
    fileInput.addEventListener("change", (e) => {
        if (e.target.files.length) {
            const src = URL.createObjectURL(e.target.files[0]);
            imagePreview.src = src;
            uploadedImgContainer.classList.remove("d-none");
        }
    });

    // حذف الصورة الحالية
    removeButton.addEventListener("click", () => {
        imagePreview.src = "";
        uploadedImgContainer.classList.add("d-none");
        fileInput.value = "";
    });
</script>';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <form action="{{ route('admin.about.updateOrCreate') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    {{-- About --}}
                    <div class="col-md-12 mb-20">
                        <label for="about" class="form-label fw-semibold text-primary-light text-sm mb-8">
                            من نحن <span class="text-danger-600">*</span>
                        </label>
                        <textarea name="about" id="about" class="form-control @error('about') is-invalid @enderror">{{ old('about', $about->about ?? '') }}</textarea>
                        @error('about')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Vision --}}
                    <div class="col-md-12 mb-20">
                        <label for="vision" class="form-label fw-semibold text-primary-light text-sm mb-8">
                            رؤيتنا <span class="text-danger-600">*</span>
                        </label>
                        <textarea name="vision" id="vision" class="form-control @error('vision') is-invalid @enderror">{{ old('vision', $about->vision ?? '') }}</textarea>
                        @error('vision')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- رفع وعرض صورة About --}}
                    <div class="col-md-12 mb-20">
                        <div class="card h-100 p-0">
                            <div class="card-header border-bottom bg-base py-16 px-24">
                                <h6 class="text-lg fw-semibold mb-0">رفع الصور</h6>
                            </div>
                            <div class="card-body p-24">
                                <div class="upload-image-wrapper d-flex align-items-center gap-3">

                                    {{-- الصورة القديمة أو الحالية --}}
                                    <div
                                        class="uploaded-img position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 {{ $about && $about->getFirstMediaUrl('about_images') ? '' : 'd-none' }}">
                                        <button type="button"
                                            class="uploaded-img__remove position-absolute top-0 end-0 z-1 text-2xxl line-height-1 me-8 mt-8 d-flex">
                                            <iconify-icon icon="radix-icons:cross-2"
                                                class="text-xl text-danger-600"></iconify-icon>
                                        </button>
                                        <img id="uploaded-img__preview" class="w-100 h-100 object-fit-cover"
                                            src="{{ $about->getFirstMediaUrl('about_images') ?: '' }}" alt="image">
                                    </div>

                                    {{-- رفع صورة جديدة --}}
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
                        <button type="submit"
                            class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                            حفظ التغييرات
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
