@extends('admin.layouts.app')

@php
    $title = 'jobs';
    $subTitle = 'All jobs';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.jobs.create') }}"
                class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Add New job
            </a>
        </div>

        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>S.L</th>
                            <th>الاسم</th>
                            {{-- description --}}
                            <th>الوصف</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobs as $job)
                            <tr>
                                <td>{{ $loop->iteration + ($jobs->currentPage() - 1) * $jobs->perPage() }}
                                </td>
                                <td>{{ $job->name }}</td>
                                <td>{{ $job->description }}</td>

                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <a href="{{ route('admin.jobs.edit', $job->id) }}"
                                            class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this job?');">
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
                                <td colspan="4" class="text-center text-muted">No jobs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Showing {{ $jobs->firstItem() ?? 0 }} to {{ $jobs->lastItem() ?? 0 }} of
                    {{ $jobs->total() ?? 0 }} entries
                </span>
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
@endsection
