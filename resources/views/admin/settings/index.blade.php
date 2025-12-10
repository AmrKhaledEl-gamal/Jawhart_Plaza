@extends('admin.layouts.app')

@section('content')
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
    <div class="container py-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h2 class="mb-4">إعدادات الموقع</h2>

        <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card mb-4">
                <div class="card-header">معلومات عامة</div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">اسم الموقع</label>
                        <input type="text" name="site_name" class="form-control" value="{{ $settings->site_name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Meta Description</label>
                        <textarea name="site_meta_description" class="form-control" rows="3">{{ $settings->site_meta_description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="site_meta_keywords" class="form-control"
                            value="{{ $settings->site_meta_keywords }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Meta Author</label>
                        <input type="text" name="site_meta_author" class="form-control"
                            value="{{ $settings->site_meta_author }}">
                    </div>

                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header">معلومات التواصل</div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">العنوان</label>
                        <input type="text" name="address" class="form-control" value="{{ $settings->address }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" name="phone_number" class="form-control"
                            value="{{ $settings->phone_number }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" value="{{ $settings->email }}">
                    </div>

                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header">السوشيال ميديا</div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="url" name="facebook" class="form-control" value="{{ $settings->facebook }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Instagram</label>
                        <input type="url" name="instagram" class="form-control" value="{{ $settings->instagram }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">WhatsApp</label>
                        <input type="url" name="whatsapp" class="form-control" value="{{ $settings->whatsapp }}">
                    </div>

                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header">الصور</div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="site_logo" class="form-control">

                        @if ($settings->site_logo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="logo" height="60">
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Favicon</label>
                        <input type="file" name="site_favicon" class="form-control">

                        @if ($settings->site_favicon)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $settings->site_favicon) }}" alt="favicon" height="40">
                            </div>
                        @endif
                    </div>

                </div>
            </div>


            <button type="submit" class="btn btn-primary w-100">حفظ الإعدادات</button>

        </form>

    </div>
@endsection
