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
                    <label>Update Image</label>
                    <input type="file" name="image" class="form-control">
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
                    <select name="color_id" class="form-select" required>
                        <option value="">Color</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
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
        <table class="table mt-24">
            <thead>
                <tr>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="variants-table">
                @foreach ($product->variants as $variant)
                    <tr id="variant-row-{{ $variant->id }}">
                        <td>
                            <span
                                style="display:inline-block;width:24px;height:24px;background-color:{{ $variant->color->code }};border-radius:50%;border:1px solid #ccc;"></span>
                        </td>
                        <td>{{ $variant->size->name }}</td>
                        <td>{{ $variant->price }}</td>
                        <td>{{ $variant->stock }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-variant" data-id="{{ $variant->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection

@section('scripts')
    <script>
        /* =======================
                   ADD VARIANT (AJAX)
                ======================= */
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
                <td>${data.variant.color}</td>
                <td>${data.variant.size}</td>
                <td>${data.variant.price}</td>
                <td>${data.variant.stock}</td>
                <td>
                    <button class="btn btn-sm btn-danger delete-variant"
                        data-id="${data.variant.id}">
                        Delete
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

            fetch(`/admin/variants/${id}`, {
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
