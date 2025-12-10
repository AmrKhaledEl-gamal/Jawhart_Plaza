@extends('admin.layouts.app')

@php
    $title = 'products';
    $subTitle = 'All products';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <a href="{{ route('admin.products.create') }}"
                class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                أضف منتج جديد
            </a>
        </div>

        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>S.L</th>
                            <th>الصورة</th>
                            <th>اسم المنتج</th>
                            <th>القسم</th>
                            <th class="text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>

                                {{-- ✅ Images --}}
                                <td class="text-center">
                                    <img src="{{ $product->getFirstMediaUrl('products', 'thumb') }}"
                                        alt="{{ $product->title }}" width="60" height="60" class="rounded">
                                </td>

                                {{-- ✅ Title --}}
                                <td>{{ $product->title }}</td>

                                {{-- ✅ City --}}
                                <td>{{ $product->category->title ?? 'N/A' }}</td>


                                {{-- ✅ Actions --}}
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0">
                                                <iconify-icon icon="fluent:delete-24-regular"
                                                    class="menu-icon"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No products found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of
                    {{ $products->total() ?? 0 }} entries
                </span>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
