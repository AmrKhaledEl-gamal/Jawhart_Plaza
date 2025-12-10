@extends('admin.layouts.app')

@php
    $title = 'Banners';
    $subTitle = 'All Banners';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">

            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
                    Add New Banner
                </a>
            </div>

            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>S.L</th>
                            <th>الرابط</th>
                            <th>الصورة</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($banners as $banner)
                            <tr>
                                <td>{{ $loop->iteration + ($banners->currentPage() - 1) * $banners->perPage() }}</td>

                                <td>{{ $banner->link ?? '-' }}</td>

                                <td>
                                    <img src="{{ $banner->getFirstMediaUrl('banners') }}" width="80" class="rounded">
                                </td>

                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">

                                        <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                            class="bg-primary-focus bg-hover-primary-200 text-primary-600 fw-medium w-40-px h-40-px
                                        d-flex justify-content-center align-items-center rounded-circle border-0">
                                            <iconify-icon icon="fluent:edit-24-regular" class="menu-icon"></iconify-icon>
                                        </a>

                                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this banner?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px
                                            d-flex justify-content-center align-items-center rounded-circle border-0">
                                                <iconify-icon icon="fluent:delete-24-regular"
                                                    class="menu-icon"></iconify-icon>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No banners found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Showing {{ $banners->firstItem() ?? 0 }} to {{ $banners->lastItem() ?? 0 }} of
                    {{ $banners->total() ?? 0 }} entries
                </span>

                {{ $banners->links() }}
            </div>

        </div>
    </div>
@endsection
