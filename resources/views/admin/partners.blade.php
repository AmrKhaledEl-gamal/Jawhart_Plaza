@extends('admin.layouts.app')

@php
    $title = 'Partners';
    $subTitle = 'Partners';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Website</th>
                            <th>Message</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($partners as $partner)
                            <tr>
                                <td>{{ $loop->iteration + ($partners->currentPage() - 1) * $partners->perPage() }}</td>

                                <td>{{ $partner->name }}</td>
                                <td>{{ $partner->email }}</td>
                                <td>{{ $partner->company }}</td>
                                <td>{{ $partner->phone }}</td>
                                <td>{{ $partner->country }}</td>
                                <td>{{ $partner->website }}</td>
                                <td>{{ $partner->message }}</td>

                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this request?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium
                                                       w-40-px h-40-px d-flex justify-content-center
                                                       align-items-center rounded-circle border-0">
                                                <iconify-icon icon="fluent:delete-24-regular"
                                                    class="menu-icon"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No partner requests found</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Showing {{ $partners->firstItem() ?? 0 }} to {{ $partners->lastItem() ?? 0 }} of
                    {{ $partners->total() ?? 0 }} entries
                </span>

                {{ $partners->links() }}
            </div>
        </div>
    </div>
@endsection
