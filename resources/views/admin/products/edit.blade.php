@extends('admin.layouts.app')

@php
    $title = 'Edit Product';
    $subTitle = 'Manage Product & Variants';
@endphp

@section('content')
    <div class="card p-24">

        {{-- Update Product --}}
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-20">
                    <label>Name (AR)</label>
                    <input type="text" name="name[ar]" class="form-control"
                        value="{{ $product->getTranslation('name', 'ar') }}">
                </div>

                <div class="col-md-6 mb-20">
                    <label>Name (EN)</label>
                    <input type="text" name="name[en]" class="form-control"
                        value="{{ $product->getTranslation('name', 'en') }}">
                </div>

                <div class="col-md-6 mb-20">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
                </div>

                <div class="col-md-6 mb-20">
                    <label>Category</label>
                    <select name="category_id" class="form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-20">
                    <label>Base Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}">
                </div>

                <div class="col-md-6 mb-20 d-flex align-items-center">
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input" type="checkbox" name="is_active"
                            {{ $product->is_active ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>

                <div class="col-md-12 mb-20">
                    <label class="form-label">Update Image</label>
                    <input id="product-image-input" type="file" name="image" class="form-control" accept="image/*">

                    <div class="mt-2 d-flex align-items-center gap-3">
                        @php($currentImg = $product->getFirstMediaUrl('products'))
                        @if (!empty($currentImg))
                            <img id="product-image-preview" src="{{ $currentImg }}" alt="product" width="90" height="90"
                                class="rounded" style="object-fit: cover;">
                        @else
                            <img id="product-image-preview" src="" alt="preview" width="90" height="90" class="rounded d-none"
                                style="object-fit: cover;">
                        @endif
                        <small class="text-muted">Choose an image to preview before saving.</small>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">Update Product</button>
                </div>

            </div>
        </form>

        <hr class="my-32">

        {{-- Add Variant --}}
        <h5 class="mb-16">Product Variants</h5>

        <form id="variant-form">
            @csrf
            <div class="row">

                <div class="col-md-3">
                    <label class="form-label">Color</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($colors as $color)
                            <label class="variant-color-option d-inline-flex align-items-center gap-2 border radius-8 px-8 py-6"
                                style="cursor:pointer;">
                                <input type="radio" name="color_id" value="{{ $color->id }}" required>
                                <span title="{{ $color->code }}"
                                    style="display:inline-block;width:18px;height:18px;background-color:{{ $color->code }};border-radius:50%;border:1px solid #ccc;"></span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="size_id" class="form-select" required>
                        <option value="">Size</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required>
                </div>

                <div class="col-md-2">
                    <input type="number" name="stock" class="form-control" placeholder="Stock" required>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-success w-100">Add</button>
                </div>

            </div>
        </form>

        {{-- Variants Table --}}
        <div class="table-responsive scroll-sm mt-24">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="variants-table">
                    @forelse ($product->variants as $variant)
                        <tr id="variant-row-{{ $variant->id }}">
                            <td>
                                <span title="{{ $variant->color->code }}"
                                    style="display:inline-block;width:24px;height:24px;background-color:{{ $variant->color->code }};border-radius:50%;border:1px solid #ccc;"></span>
                            </td>
                            <td>{{ $variant->size->name }}</td>
                            <td>{{ $variant->price }}</td>
                            <td>{{ $variant->stock }}</td>
                            <td class="text-center">
                                <button type="button" class="delete-variant bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px
                                    d-inline-flex justify-content-center align-items-center rounded-circle border-0"
                                    data-id="{{ $variant->id }}" title="Delete">
                                    <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No variants yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('scripts')
    <style>
        .variant-color-option.selected {
            border-color: #0d6efd !important;
            background: rgba(13, 110, 253, 0.08);
            box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
        }

        .variant-color-option input[type="radio"] {
            accent-color: #0d6efd;
        }
    </style>

    <script>
        /* =======================
                   ADD VARIANT (AJAX)
                ======================= */
        // Highlight selected color swatch
        function syncSelectedColorSwatch() {
            document.querySelectorAll('.variant-color-option').forEach((label) => label.classList.remove('selected'));
            const checked = document.querySelector('input[name="color_id"]:checked');
            if (checked && checked.closest('.variant-color-option')) {
                checked.closest('.variant-color-option').classList.add('selected');
            }
        }
        document.addEventListener('change', function(e) {
            if (e.target && e.target.matches('input[name="color_id"]')) {
                syncSelectedColorSwatch();
            }
        });
        syncSelectedColorSwatch();

        // Product image preview
        const productImageInput = document.getElementById('product-image-input');
        const productImagePreview = document.getElementById('product-image-preview');
        if (productImageInput && productImagePreview) {
            productImageInput.addEventListener('change', (e) => {
                if (!e.target.files || !e.target.files.length) return;
                const src = URL.createObjectURL(e.target.files[0]);
                productImagePreview.src = src;
                productImagePreview.classList.remove('d-none');
            });
        }

        document.getElementById('variant-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            fetch("{{ route('admin.products.variants.store', $product) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(data => {

                    const row = `
            <tr id="variant-row-${data.variant.id}">
                <td>
                    <span title="${data.variant.color_code}"
                        style="display:inline-block;width:24px;height:24px;background-color:${data.variant.color_code};border-radius:50%;border:1px solid #ccc;"></span>
                </td>
                <td>${data.variant.size}</td>
                <td>${data.variant.price}</td>
                <td>${data.variant.stock}</td>
                <td class="text-center">
                    <button type="button" class="delete-variant bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px
                        d-inline-flex justify-content-center align-items-center rounded-circle border-0"
                        data-id="${data.variant.id}" title="Delete">
                        <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                    </button>
                </td>
            </tr>
        `;

                    document.getElementById('variants-table')
                        .insertAdjacentHTML('beforeend', row);

                    form.reset();
                })
                .catch(async err => {
                    const res = await err.json();
                    alert(res.message || 'Error adding variant');
                });
        });

        /* =======================
           DELETE VARIANT (AJAX)
        ======================= */
        document.addEventListener('click', function(e) {
            if (!e.target.classList.contains('delete-variant')) return;

            const id = e.target.dataset.id;
            if (!confirm('Delete this variant?')) return;

            const deleteBaseUrl = "{{ url('admin/products/' . $product->id . '/variants') }}";

            fetch(`${deleteBaseUrl}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (!res.ok) throw res;
                    document.getElementById(`variant-row-${id}`).remove();
                })
                .catch(() => alert('Failed to delete variant'));
        });
    </script>
@endsection
