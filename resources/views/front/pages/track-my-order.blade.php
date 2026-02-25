@extends('front.layouts.app')
@section('content')
    <div class="trackOrder">
        <div class="box">
            <h1 class="trc h1b20">tracking my order</h1>
        </div>

        {{-- Search Form --}}
        <div class="box">
            <form action="{{ route('front.track-order.track') }}" method="POST" class="track-search-form">
                @csrf
                <div class="search-wrapper">
                    <input type="text" name="order_id" placeholder="Enter your order ID (e.g., 1234567)"
                        value="{{ old('order_id', $order->id ?? '') }}" required>
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i> Track
                    </button>
                </div>
                @if (session('error'))
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif
            </form>
        </div>

        @if (isset($order))
            <div class="box trackBoxs">
                <div class="trackData">
                    <h2>order details <i class="fa-regular fa-angle-down"></i></h2>
                    <div class="orderDataRows">
                        <div class="datar">
                            <span>order iD</span>
                            <span># {{ $order->id }}</span>
                        </div>
                        <div class="datar">
                            <span>items order</span>
                            <span>{{ $order->items->count() }} {{ $order->items->count() == 1 ? 'item' : 'items' }}</span>
                        </div>
                        <div class="datar">
                            <span>order total</span>
                            <span>{{ number_format($order->total_amount, 2) }} JD</span>
                        </div>
                    </div>
                    <h2>delivery details <i class="fa-regular fa-angle-down"></i></h2>
                    <div class="orderDataRows">
                        <div class="datar">
                            <span>payment method</span>
                            <span>{{ $order->payment_method == 'cash' ? 'Cash on Delivery' : 'Visa' }}</span>
                        </div>
                        <div class="datar">
                            <span>shipping address</span>
                            <span>{{ $order->shipping_address }}</span>
                        </div>
                        <div class="datar">
                            <span>order date</span>
                            <span>{{ $order->created_at->format('l, d M Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="mapandprogress">
                    <div id="map"></div>
                    <div class="order-status">
                        <h2>Order Status</h2>
                        <div class="delvDate">
                            @if ($order->status == 'delivered')
                                delivered on : <span>{{ $order->updated_at->format('l, d M Y') }}</span>
                            @elseif($order->status == 'cancelled')
                                order cancelled
                            @else
                                estimated delivery date :
                                <span>{{ $order->created_at->addDays(5)->format('l, d M Y') }}</span>
                            @endif
                        </div>
                        {{-- Status: finished, inprogress, pending as classes --}}
                        @php
                            $statuses = ['pending', 'paid', 'shipped', 'delivered'];
                            $currentIndex = array_search($order->status, $statuses);
                            if ($currentIndex === false) {
                                $currentIndex = -1;
                            } // cancelled
                        @endphp
                        <div class="progressBars">
                            {{-- Ordered (Pending) --}}
                            <div
                                class="pbar {{ $currentIndex >= 0 ? ($currentIndex > 0 ? 'finished' : 'inprogress') : 'pending' }}">
                                <span></span>
                                <div class="trackTitle">
                                    @if ($currentIndex > 0)
                                        <img src="{{ asset('media/icons/check.svg') }}" alt="">
                                    @elseif($currentIndex == 0)
                                        <i class="fa-duotone fa-spinner-third"></i>
                                    @else
                                        <img src="{{ asset('media/icons/not.svg') }}" alt="">
                                    @endif
                                    ordered
                                </div>
                            </div>
                            {{-- Paid --}}
                            <div
                                class="pbar {{ $currentIndex >= 1 ? ($currentIndex > 1 ? 'finished' : 'inprogress') : 'pending' }}">
                                <span></span>
                                <div class="trackTitle">
                                    @if ($currentIndex > 1)
                                        <img src="{{ asset('media/icons/check.svg') }}" alt="">
                                    @elseif($currentIndex == 1)
                                        <i class="fa-duotone fa-spinner-third"></i>
                                    @else
                                        <img src="{{ asset('media/icons/not.svg') }}" alt="">
                                    @endif
                                    paid
                                </div>
                            </div>
                            {{-- Shipped --}}
                            <div
                                class="pbar {{ $currentIndex >= 2 ? ($currentIndex > 2 ? 'finished' : 'inprogress') : 'pending' }}">
                                <span></span>
                                <div class="trackTitle">
                                    @if ($currentIndex > 2)
                                        <img src="{{ asset('media/icons/check.svg') }}" alt="">
                                    @elseif($currentIndex == 2)
                                        <i class="fa-duotone fa-spinner-third"></i>
                                    @else
                                        <img src="{{ asset('media/icons/not.svg') }}" alt="">
                                    @endif
                                    shipped
                                </div>
                            </div>
                            {{-- Delivered --}}
                            <div class="pbar {{ $currentIndex >= 3 ? 'finished' : 'pending' }}">
                                <span></span>
                                <div class="trackTitle">
                                    @if ($currentIndex >= 3)
                                        <img src="{{ asset('media/icons/check.svg') }}" alt="">
                                    @else
                                        <img src="{{ asset('media/icons/not.svg') }}" alt="">
                                    @endif
                                    delivered
                                </div>
                            </div>
                        </div>
                        @if ($order->status == 'cancelled')
                            <div class="cancelled-notice">
                                <i class="fa-solid fa-ban"></i> This order has been cancelled
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="box track-empty-state">
                <div class="empty-icon">
                    <i class="fa-light fa-box-open"></i>
                </div>
                <h3>Track Your Order</h3>
                <p>Enter your order ID above to see the current status of your order.</p>
            </div>
        @endif
    </div>

    <style>
        .track-search-form {
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .track-search-form .search-wrapper {
            display: flex;
            gap: 10px;
            background: var(--White-color);
            padding: 8px;
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .track-search-form input {
            flex: 1;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            outline: none;
            background: transparent;
        }

        .track-search-form button {
            background: var(--Gold-color);
            color: var(--White-color);
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .track-search-form button:hover {
            background: var(--Gold-color-dark, #8b6a3f);
            transform: translateY(-2px);
        }

        .error-message {
            color: #dc3545;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background: #f8d7da;
            border-radius: 8px;
        }

        .track-empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .track-empty-state .empty-icon {
            font-size: 80px;
            color: var(--Gold-color);
            margin-bottom: 20px;
        }

        .track-empty-state h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: var(--Black-color);
        }

        .track-empty-state p {
            color: #666;
            font-size: 16px;
        }

        .cancelled-notice {
            margin-top: 20px;
            padding: 15px;
            background: #f8d7da;
            color: #721c24;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
        }
    </style>
@endsection
