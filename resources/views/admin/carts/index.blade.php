@extends('admin.layouts.app')

@php
    $title = 'Carts';
    $subTitle = 'All carts';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carts as $cart)
                            <tr>
                                <td>{{ $loop->iteration + ($carts->currentPage() - 1) * $carts->perPage() }}</td>
                                <td>{{ optional($cart->created_at)->format('d M Y') }}</td>
                                <td>
                                    {{ $cart->user->name ?? '—' }}
                                    <div class="text-muted text-sm">{{ $cart->user->email ?? '' }}</div>
                                </td>
                                <td>{{ $cart->product->name ?? '—' }}</td>
                                <td>{{ $cart->quantity ?? 1 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No carts found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Showing {{ $carts->firstItem() ?? 0 }} to {{ $carts->lastItem() ?? 0 }} of {{ $carts->total() ?? 0 }} entries
                </span>
                {{ $carts->links() }}
            </div>
        </div>
    </div>
@endsection
