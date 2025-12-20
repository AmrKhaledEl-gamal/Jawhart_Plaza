@extends('front.layouts.app')
@section('content')
    <div class="home pageBanner pageBanner2 pageBanner4">
        <img class="pageBannerImage" src="{{ asset('front/media/wholesale.png') }}" alt="">
        <div class="box ktx z2">
            <h2 class="tru">
                Do you own a store and looking for wholesale prices? Contact us for the best deals!"
            </h2>
        </div>
    </div>

    <div class="contactPage">
        <div class="box contact">
            <div class="formcontrol">
                <h2>Send us a wholesale request:</h2>
                <form class="form" method="POST" action="{{ route('front.wholesale.store') }}">
                    @csrf
                    <div class="input">
                        <span>full name :</span>
                        <input type="text" placeholder="Full name" name="name">

                    </div>
                    <div class="input">
                        <span>Company Name :</span>
                        <input type="text" name="company_name" placeholder="Company Name">
                    </div>
                    <div class="input">
                        <span>Phone :</span>
                        <input type="tel" name="phone" placeholder="Ex : +966XXXXXXXXX">
                    </div>
                    <div class="input">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="email">
                    </div>
                    <div class="input">
                        <span>Product SKU :</span>
                        <input type="text" name="sku" placeholder="Product SKU">
                    </div>
                    <div class="input">
                        <span>Quantity :</span>
                        <input type="number" name="quantity" placeholder="Quantity">
                    </div>
                    <div class="input">
                        <span>Custom Logo :</span>
                        <div class="labels">
                            <div class="label">
                                <input type="radio" id="i1" name="has_logo" value="0">
                                <label for="i1">Without Logo</label>
                            </div>

                            <div class="label">
                                <input type="radio" id="i2" name="has_logo" value="1">
                                <label for="i2">With Logo</label>
                            </div>
                        </div>

                    </div>
                    <div class="input">
                        <span>notes :</span>
                        <textarea name="message" placeholder="notes"></textarea>
                    </div>
                    <button class="store mla">Send </button>
                </form>
            </div>
        </div>
    </div>
@endsection
