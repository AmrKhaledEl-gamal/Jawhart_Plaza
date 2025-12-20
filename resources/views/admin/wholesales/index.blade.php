@extends('admin.layouts.app')
@php
    $title = 'wholesales ';
    $subTitle = 'wholesales';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24">
            <h6 class="text-lg fw-semibold mb-0">wholesales</h6>
        </div>
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>S.L</th>
                            <th>name</th>
                            <th>company name</th>
                            <th>Email</th>
                            <th>phone number</th>
                            <th>SKU</th>
                            <th>quantity</th>
                            <th>Logo</th>
                            <th>message</th>

                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wholesales as $wholesale)
                            <tr>
                                <td>{{ $loop->iteration + ($wholesales->currentPage() - 1) * $wholesales->perPage() }}</td>
                                {{-- ✅ Title translations --}}
                                <td>{{ $wholesale->name }}</td>
                                <td>{{ $wholesale->company_name }}</td>
                                <td>{{ $wholesale->email }}</td>
                                <td>{{ $wholesale->phone }}</td>
                                <td>{{ $wholesale->sku }}</td>
                                <td class="badge bg-success">{{ $wholesale->quantity }}</td>
                                <td>
                                    <span class="badge {{ $wholesale->has_logo ? 'bg-success' : 'bg-danger' }}">
                                        {{ $wholesale->has_logo ? 'Whit Logo' : 'without Logo' }}
                                    </span>
                                </td>
                                <td>{{ $wholesale->message }}</td>

                                {{-- ✅ Actions --}}
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <form action="{{ route('admin.wholesales.destroy', $wholesale->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this wholesale?');">
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
                                <td colspan="6" class="text-center text-muted">no date available </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Showing {{ $wholesales->firstItem() ?? 0 }} to {{ $wholesales->lastItem() ?? 0 }} of
                    {{ $wholesales->total() ?? 0 }} entries
                </span>
                {{ $wholesales->links() }}
            </div>
        </div>
    </div>
@endsection
