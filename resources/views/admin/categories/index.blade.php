@extends('admin.layouts.app')

@php
    $title = 'categories';
    $subTitle = 'All categories';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        {{-- <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.categories.create') }}"
                class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Add New category
            </a>
        </div> --}}

        <div class="card-body p-24">
            <div class="table-responsive">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>الصورة</th>
                            <th>الاسم</th>
                            <th>التصنيف الرئيسي</th>
                            <th class="text-center">العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <img src="{{ $category->getFirstMediaUrl('cover') }}" alt="{{ $category->name }}"
                                        width="60" height="60" class="rounded">
                                </td>
                                <td>{{ $category->getTranslation('name', app()->getLocale()) }}</td>
                                <td>
                                    {{ $category->parent ? $category->parent->getTranslation('name', app()->getLocale()) : '-' }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');"
                                            style="display:inline-block;">
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
                                <td colspan="5" class="text-center text-muted">لا يوجد تصنيفات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of
                    {{ $categories->total() ?? 0 }} entries
                </span>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
