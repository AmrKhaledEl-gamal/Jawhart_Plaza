@extends('admin.layouts.app')

@php
    $title = 'Settings';
    $subTitle = 'Site settings';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24">
            <h6 class="text-lg fw-semibold mb-0">إعدادات الموقع</h6>
        </div>

        <div class="card-body p-24">
            <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card mb-4">
                    <div class="card-header">معلومات عامة</div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">اسم الموقع (AR)</label>
                                <input type="text" name="site_name[ar]" class="form-control"
                                    value="{{ is_array($settings->site_name) ? ($settings->site_name['ar'] ?? '') : '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Site Name (EN)</label>
                                <input type="text" name="site_name[en]" class="form-control"
                                    value="{{ is_array($settings->site_name) ? ($settings->site_name['en'] ?? '') : ($settings->site_name ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Description (AR)</label>
                                <textarea name="site_meta_description[ar]" class="form-control" rows="3">{{ is_array($settings->site_meta_description) ? ($settings->site_meta_description['ar'] ?? '') : '' }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Description (EN)</label>
                                <textarea name="site_meta_description[en]" class="form-control" rows="3">{{ is_array($settings->site_meta_description) ? ($settings->site_meta_description['en'] ?? '') : ($settings->site_meta_description ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <input type="text" name="site_meta_keywords" class="form-control" value="{{ $settings->site_meta_keywords }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Author</label>
                            <input type="text" name="site_meta_author" class="form-control" value="{{ $settings->site_meta_author }}">
                        </div>

                    </div>
                </div>


                <div class="card mb-4">
                    <div class="card-header">معلومات التواصل</div>
                    <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">العنوان (AR)</label>
                            <input type="text" name="address[ar]" class="form-control"
                                value="{{ is_array($settings->address) ? ($settings->address['ar'] ?? '') : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Address (EN)</label>
                            <input type="text" name="address[en]" class="form-control"
                                value="{{ is_array($settings->address) ? ($settings->address['en'] ?? '') : ($settings->address ?? '') }}">
                        </div>
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
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Logo</label>
                                <input id="site-logo-input" type="file" name="site_logo" class="form-control" accept="image/*">
                                <div class="mt-2 d-flex align-items-center gap-3">
                                    @if (!empty($settings->site_logo))
                                        <img id="site-logo-preview" src="{{ asset('storage/' . $settings->site_logo) }}" alt="logo"
                                            width="90" height="90" class="rounded" style="object-fit: cover;">
                                    @else
                                        <img id="site-logo-preview" src="" alt="logo" width="90" height="90" class="rounded d-none"
                                            style="object-fit: cover;">
                                    @endif
                                    <small class="text-muted">Preview logo before saving.</small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Favicon</label>
                                <input id="site-favicon-input" type="file" name="site_favicon" class="form-control" accept="image/*">
                                <div class="mt-2 d-flex align-items-center gap-3">
                                    @if (!empty($settings->site_favicon))
                                        <img id="site-favicon-preview" src="{{ asset('storage/' . $settings->site_favicon) }}" alt="favicon"
                                            width="48" height="48" class="rounded" style="object-fit: cover;">
                                    @else
                                        <img id="site-favicon-preview" src="" alt="favicon" width="48" height="48" class="rounded d-none"
                                            style="object-fit: cover;">
                                    @endif
                                    <small class="text-muted">Preview favicon before saving.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-32">حفظ الإعدادات</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function bindImagePreview(inputId, imgId) {
            const input = document.getElementById(inputId);
            const img = document.getElementById(imgId);
            if (!input || !img) return;

            input.addEventListener('change', (e) => {
                if (!e.target.files || !e.target.files.length) return;
                const src = URL.createObjectURL(e.target.files[0]);
                img.src = src;
                img.classList.remove('d-none');
            });
        }

        bindImagePreview('site-logo-input', 'site-logo-preview');
        bindImagePreview('site-favicon-input', 'site-favicon-preview');
    </script>
@endsection
