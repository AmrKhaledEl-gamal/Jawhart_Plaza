@extends('front.layouts.app')
@section('content')
    <div class="home pageBanner pageBanner2 pageBanner4 pageBanner5">
        <img class="pageBannerImage" src="../media/checkout.png" alt="">
    </div>

    <div class="contactPage">
        <form action="{{ route('front.checkout.store') }}" method="POST" class="box contact max1000">
            @csrf

            @if ($errors->any())
                <div
                    style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; width: 100%;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="formcontrol bgtrans">
                <h2> Billing details</h2>
                <div class="form">
                    <div class="inputs">
                        <div class="input">
                            <span>Full Name:</span>
                            <input type="text" name="name" placeholder="Full Name"
                                value="{{ auth()->user()->name ?? '' }}">
                        </div>
                        <div class="input">
                            <span>Phone Number:</span>
                            <input type="tel" name="phone" placeholder="Phone Number with Code"
                                value="{{ auth()->user()->phone ?? '' }}">
                        </div>
                    </div>
                    <div class="inputs">
                        <div class="input">
                            <span>Country:</span>
                            <div class="select">
                                <select name="country">
                                    <option value="">Choose Country</option>
                                    <option value="jordan"
                                        {{ (auth()->user()->country ?? '') == 'jordan' ? 'selected' : '' }}>Jordan</option>
                                    <option value="saudi_arabia"
                                        {{ (auth()->user()->country ?? '') == 'saudi_arabia' ? 'selected' : '' }}>Saudi
                                        Arabia</option>
                                    <option value="uae" {{ (auth()->user()->country ?? '') == 'uae' ? 'selected' : '' }}>
                                        UAE</option>
                                    <option value="qatar"
                                        {{ (auth()->user()->country ?? '') == 'qatar' ? 'selected' : '' }}>Qatar</option>
                                    <option value="kuwait"
                                        {{ (auth()->user()->country ?? '') == 'kuwait' ? 'selected' : '' }}>Kuwait</option>
                                    <option value="oman"
                                        {{ (auth()->user()->country ?? '') == 'oman' ? 'selected' : '' }}>Oman</option>
                                    <option value="bahrain"
                                        {{ (auth()->user()->country ?? '') == 'bahrain' ? 'selected' : '' }}>Bahrain
                                    </option>
                                    <option value="syria"
                                        {{ (auth()->user()->country ?? '') == 'syria' ? 'selected' : '' }}>Syria</option>
                                    <option value="lebanon"
                                        {{ (auth()->user()->country ?? '') == 'lebanon' ? 'selected' : '' }}>Lebanon
                                    </option>
                                    <option value="palestine"
                                        {{ (auth()->user()->country ?? '') == 'palestine' ? 'selected' : '' }}>Palestine
                                    </option>
                                    <option value="yemen"
                                        {{ (auth()->user()->country ?? '') == 'yemen' ? 'selected' : '' }}>Yemen</option>
                                    <option value="egypt"
                                        {{ (auth()->user()->country ?? '') == 'egypt' ? 'selected' : '' }}>Egypt</option>
                                    <option value="morocco"
                                        {{ (auth()->user()->country ?? '') == 'morocco' ? 'selected' : '' }}>Morocco
                                    </option>
                                    <option value="algeria"
                                        {{ (auth()->user()->country ?? '') == 'algeria' ? 'selected' : '' }}>Algeria
                                    </option>
                                    <option value="tunisia"
                                        {{ (auth()->user()->country ?? '') == 'tunisia' ? 'selected' : '' }}>Tunisia
                                    </option>
                                    <option value="libya"
                                        {{ (auth()->user()->country ?? '') == 'libya' ? 'selected' : '' }}>Libya</option>
                                    <option value="sudan"
                                        {{ (auth()->user()->country ?? '') == 'sudan' ? 'selected' : '' }}>Sudan</option>
                                    <option value="usa"
                                        {{ (auth()->user()->country ?? '') == 'usa' ? 'selected' : '' }}>USA</option>
                                    <option value="uk" {{ (auth()->user()->country ?? '') == 'uk' ? 'selected' : '' }}>
                                        UK</option>
                                    <option value="ue" {{ (auth()->user()->country ?? '') == 'ue' ? 'selected' : '' }}>
                                        EU</option>
                                    <option value="somalia"
                                        {{ (auth()->user()->country ?? '') == 'somalia' ? 'selected' : '' }}>Somalia
                                    </option>
                                    <option value="mauritania"
                                        {{ (auth()->user()->country ?? '') == 'mauritania' ? 'selected' : '' }}>Mauritania
                                    </option>
                                    <option value="djibouti"
                                        {{ (auth()->user()->country ?? '') == 'djibouti' ? 'selected' : '' }}>Djibouti
                                    </option>
                                    <option value="comoros"
                                        {{ (auth()->user()->country ?? '') == 'comoros' ? 'selected' : '' }}>Comoros
                                    </option>
                                    <option value="other"
                                        {{ (auth()->user()->country ?? '') == 'other' ? 'selected' : '' }}>Other Country
                                    </option>
                                </select>
                                <i class="fa-regular fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="input">
                            <span>City:</span>
                            <input type="text" name="city" placeholder="City"
                                value="{{ auth()->user()->city ?? '' }}">
                        </div>
                    </div>
                    <div class="input">
                        <span>Email:</span>
                        <input type="email" name="email" placeholder="Email" value="{{ auth()->user()->email ?? '' }}">
                    </div>
                    <div class="input">
                        <span>Address:</span>
                        <input type="text" name="address" placeholder="Address"
                            value="{{ auth()->user()->address ?? '' }}">
                    </div>
                    <div class="input">
                        <span>Apartment, Suite, etc.:</span>
                        <input type="text" name="apartment" placeholder="Apartment, Suite, etc."
                            value="{{ auth()->user()->apartment ?? '' }}">
                    </div>
                    <div class="label lbl">
                        <input type="checkbox" id="lbl1">
                        <label for="lbl1">
                            create an account ?
                        </label>
                    </div>
                    <div class="label lbl">
                        <input type="checkbox" id="lbl2">
                        <label for="lbl2">
                            Ship to a different address ?
                        </label>
                    </div>
                    <div class="input">
                        <span>Order notes (optional)</span>
                        <textarea name="notes" placeholder="Order notes (optional)"></textarea>
                    </div>
                </div>
            </div>

            <div class="dflexde">
                <div class="cheCard">
                    <div class="cardc">
                        <h2>Order Summary</h2>
                        <div class="toItems">
                            <span>{{ $cartItems->count() }} Items</span> - <span>{{ number_format($subtotal, 2) }}
                                {{ __('front.currency') }}</span>
                        </div>
                        <div class="itemsData">
                            @foreach ($cartItems as $item)
                                @php
                                    $price =
                                        $item->variant->price ??
                                        ($item->product->discount_price ?? $item->product->price);
                                @endphp
                                <div class="toItems">
                                    <span>{{ $item->product->name }} (*{{ $item->quantity }})</span>
                                    <span>{{ number_format($price * $item->quantity, 2) }}
                                        {{ __('front.currency') }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="nubs">
                            <div class="nrow">
                                <span>Subtotal</span>
                                <span>{{ number_format($subtotal, 2) }} {{ __('front.currency') }}</span>
                            </div>
                        </div>
                        <div class="toItems">
                            <span>Total</span> - <span>{{ number_format($subtotal, 2) }} {{ __('front.currency') }}</span>
                        </div>
                        <div class="cop">
                            <div class="input applyInput">
                                <input type="text" placeholder="Gift Card or Discount Code...">
                                <button type="button" class="apply">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
                <h2>Payment method</h2>
                <div class="payOptions">
                    <label for="o1">
                        <span>
                            <input type="radio" id="o1" name="payment_method" value="cash" checked>
                            cash on delivery
                        </span>
                        <p>
                            Pay with cash upon delivery</p>
                    </label>
                    <label for="o2">
                        <span>
                            <input type="radio" id="o2" name="payment_method" value="visa">
                            Online
                        </span>
                        <p>
                            Pay with visa or mastercard </p>
                    </label>
                </div>
                <div class="payMeth">
                    <p>
                        Your personal data will be used to process your order, support your experience throughout this
                        website, and
                        for other purposes described in our <a href="./privacy-policy.html">privacy policy</a> .
                    </p>
                    <div class="label">
                        <input type="checkbox" id="a1">
                        <label for="a1">
                            I have read and agree to the website <a href="./terms-conditions.html">terms and conditions</a>
                        </label>
                    </div>
                    <button type="submit" class="toPay" style="width: 100%; border: none; cursor: pointer;">Complete
                        Order</button>
                </div>
            </div>
        </form>
    </div>
@endsection
