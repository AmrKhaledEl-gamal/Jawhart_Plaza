@extends('admin.layouts.app')

@php
    $title = 'Order Details';
    $subTitle = 'Order #' . $order->id;
@endphp

@section('content')
    <div class="row">
        <div class="col-lg-4 mb-24">
            <div class="card p-24">
                <h6 class="mb-16">Customer</h6>
                <div class="mb-8"><strong>Name:</strong> {{ $order->user->name ?? '—' }}</div>
                <div class="mb-8"><strong>Email:</strong> {{ $order->user->email ?? '—' }}</div>
                <div class="mb-8"><strong>Date:</strong> {{ optional($order->created_at)->format('d M Y') }}</div>
            </div>

            <div class="card p-24 mt-24">
                <h6 class="mb-16">Status</h6>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-20">
                        <label class="form-label">Order Status</label>
                        <select name="status" class="form-select" required>
                            @php($current = old('status', $order->status ?? 'pending'))
                            <option value="pending" {{ $current === 'pending' ? 'selected' : '' }}>pending</option>
                            <option value="processing" {{ $current === 'processing' ? 'selected' : '' }}>processing</option>
                            <option value="completed" {{ $current === 'completed' ? 'selected' : '' }}>completed</option>
                            <option value="cancelled" {{ $current === 'cancelled' ? 'selected' : '' }}>cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8 mb-24">
            <div class="card p-24">
                <h6 class="mb-16">Items</h6>

                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table sm-table mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->items ?? [] as $item)
                                <tr>
                                    <td>{{ $item->product->name ?? '—' }}</td>
                                    <td>{{ $item->quantity ?? 1 }}</td>
                                    <td>{{ $item->price ?? 0 }}</td>
                                    <td>{{ ($item->price ?? 0) * ($item->quantity ?? 1) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No items found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-24">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-danger">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
