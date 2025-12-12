@extends('admin.layouts.app')
@php
    $title = 'applications ';
    $subTitle = 'applications';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>S.L</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>رقم الهاتف</th>
                            <th>تاريخ الميلاد</th>
                            <th>الوظيفة</th>
                            <th>الجنسية</th>


                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $application)
                            <tr>
                                <td>{{ $loop->iteration + ($applications->currentPage() - 1) * $applications->perPage() }}
                                </td>

                                {{-- ✅ Title translations --}}
                                <td>{{ $application->name }}</td>
                                <td>{{ $application->email }}</td>
                                <td>{{ $application->phone }}</td>
                                <td>{{ $application->birth_date }}</td>
                                <td>{{ $application->job->name }}</td>
                                <td>{{ $application->nationality }}</td>


                                {{-- ✅ Actions --}}
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <form action="{{ route('admin.applications.destroy', $application->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this application?');">
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
                                <td colspan="6" class="text-center text-muted">No applications found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Showing {{ $applications->firstItem() ?? 0 }} to {{ $applications->lastItem() ?? 0 }} of
                    {{ $applications->total() ?? 0 }} entries
                </span>
                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection
