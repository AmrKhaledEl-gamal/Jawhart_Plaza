@extends('front.layouts.app')
@section('content')
    <div class="home pageBanner beforeShadow">
        <img class="pageBannerImage" src="{{ asset('front/media/shop.png') }}" alt="">
        <div class="box ktx z2">
            <h1>A man's style starts here</h1>
            <p>
                Our collection of men's attire combines elegance and comfort, meeting all your needs for any occasion.
            </p>
            <a class="store mt20" href="#products-section">Order Now</a>
        </div>
    </div>


    <div class="bgfff p70-0" id="products-section">
        <form class="box proandf pr" method="GET" action="{{ route('front.shop.index') }}">
            <div class="filterInner">
                <div class="filter">
                    <div class="filtSection">
                        <h3>Categories</h3>
                        @foreach ($categories as $category)
                            <div class="labelinput">
                                <input type="checkbox"
                                       id="cat-{{ $category->id }}"
                                       name="categories[]"
                                       value="{{ $category->id }}"
                                       {{ in_array($category->id, (array) request('categories', [])) ? 'checked' : '' }}>
                                <label for="cat-{{ $category->id }}">
                                    {{ $category->name }}
                                    @if(isset($category->products_count))
                                        <span>({{ $category->products_count }})</span>
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="filtSection">
                        <h3>Size</h3>
                        <div class="radiosIn">
                            @foreach ($sizes as $size)
                                <div class="labelinput radio">
                                    <input type="radio"
                                           id="size-{{ $size->id }}"
                                           name="size"
                                           value="{{ $size->id }}"
                                           {{ request('size') == $size->id ? 'checked' : '' }}>
                                    <label for="size-{{ $size->id }}">{{ $size->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="filtSection">
                        <h3>Color</h3>
                        <div class="radiosIn">
                            @foreach ($colors as $color)
                                <div class="labelinput radio colorradio">
                                    <input type="radio"
                                           id="color-{{ $color->id }}"
                                           name="color"
                                           value="{{ $color->id }}"
                                           {{ request('color') == $color->id ? 'checked' : '' }}>
                                    <label for="color-{{ $color->id }}" style="background-color: {{ $color->code }};" title="{{ $color->code }}"></label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="filtSection pb0">
                        <h3>Price Range:</h3>
                        <div class="pr">
                            <div class="r-container">
                                <div class="track"></div>
                                <div class="range" id="rangeTrack"></div>
                                <input type="range" id="rangeMin" name="min_price"
                                       min="{{ $minProductPrice ?? 0 }}"
                                       max="{{ $maxProductPrice ?? 5000 }}"
                                       step="10"
                                       value="{{ request('min_price', $minProductPrice ?? 0) }}"
                                       oninput="updateRange()">
                                <input type="range" id="rangeMax" name="max_price"
                                       min="{{ $minProductPrice ?? 0 }}"
                                       max="{{ $maxProductPrice ?? 5000 }}"
                                       step="10"
                                       value="{{ request('max_price', $maxProductPrice ?? 5000) }}"
                                       oninput="updateRange()">
                            </div>
                        </div>
                        <div class="value-display">
                            <span id="rangeValue">{{ request('min_price', $minProductPrice ?? 0) }} JD - {{ request('max_price', $maxProductPrice ?? 5000) }} JD</span>
                        </div>
                    </div>
                </div>
                <div class="filter-actions">
                    <button type="submit">Apply Filter</button>
                    <a href="{{ route('front.shop.index') }}" class="reset-filter">Reset</a>
                </div>
            </div>
            <div class="projectsInner">
                <div class="projectsSearch">
                    <button type="button" class="fa-solid fa-filter-list"></button>
                    <p>{{ $products->total() }} results found</p>
                    <div class="sortBy">
                        <label for="sort">Sort by:</label>
                        <select id="sort" name="sort" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z-A</option>
                        </select>
                        <i class="fa-regular fa-angle-down"></i>
                    </div>

                </div>
                <div class="projects">
                    @forelse ($products as $product)
                        <div class="prod">
                            <div class="addToFav" tabindex="0" data-product-id="{{ $product->id }}">
                                <i class="fa-light fa-heart"></i>
                            </div>
                            <a href="{{ route('front.products.index', ['product' => $product->id]) }}" class="prodImage">
                                <img src="{{ $product->getFirstMediaUrl('products') ?: asset('front/media/placeholder.png') }}" alt="{{ $product->name }}">
                            </a>
                            <div class="nAndr">
                                <h2>{{ $product->name }}</h2>
                                <div class="rate">
                                    @php
                                        $rating = $product->reviews_avg_rating ?? 0;
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <i class="fa-solid fa-star"></i>
                                        @else
                                            <i class="fa-light fa-star"></i>
                                        @endif
                                    @endfor
                                    <span>({{ $product->reviews_count ?? 0 }})</span>
                                </div>
                            </div>
                            <div class="price">
                                <span>{{ number_format($product->price, 2) }} JD</span>
                                @if($product->discount_price && $product->discount_price < $product->price)
                                    <del>{{ number_format($product->price, 2) }} JD</del>
                                    @php
                                        $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                                    @endphp
                                    <span class="discount-badge">{{ $discountPercent }}% OFF</span>
                                @endif
                            </div>
                            <div class="btns">
                                <button type="button" onclick="AddToCart({{ json_encode(['id' => $product->id, 'name' => $product->name, 'price' => $product->price, 'image' => $product->getFirstMediaUrl('products')]) }})">
                                    Add to Cart
                                    <img src="{{ asset('front/media/icons/bag.svg') }}" alt="">
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="no-products">
                            <p>No products found matching your criteria.</p>
                            <a href="{{ route('front.shop.index') }}" class="btn">View All Products</a>
                        </div>
                    @endforelse
                </div>

                @if($products->hasPages())
                <div class="paginationCont">
                    <div class="paginations">
                        <ul class="spans">
                            {{-- Previous Page Link --}}
                            @if ($products->onFirstPage())
                                <li><span class="page-link disabled"><img src="{{ asset('front/media/icons/arrow-prev.svg') }}" alt=""></span></li>
                            @else
                                <li><a href="{{ $products->previousPageUrl() }}" class="page-link"><img src="{{ asset('front/media/icons/arrow-prev.svg') }}" alt=""></a></li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($products->links()->elements as $element)
                                {{-- "Three Dots" Separator --}}
                                @if (is_string($element))
                                    <li><span class="page-link">{{ $element }}</span></li>
                                @endif

                                {{-- Array Of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $products->currentPage())
                                            <li><span class="page-link active">{{ $page }}</span></li>
                                        @else
                                            <li><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                                <li><a href="{{ $products->nextPageUrl() }}" class="page-link"><img src="{{ asset('front/media/icons/arrow-next.svg') }}" alt=""></a></li>
                            @else
                                <li><span class="page-link disabled"><img src="{{ asset('front/media/icons/arrow-next.svg') }}" alt=""></span></li>
                            @endif
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    function updateRange() {
        const minVal = parseInt(document.getElementById('rangeMin').value);
        const maxVal = parseInt(document.getElementById('rangeMax').value);
        const min = parseInt(document.getElementById('rangeMin').min);
        const max = parseInt(document.getElementById('rangeMax').max);

        // Prevent min from exceeding max
        if (minVal > maxVal) {
            document.getElementById('rangeMin').value = maxVal;
        }

        // Update the display
        document.getElementById('rangeValue').textContent =
            document.getElementById('rangeMin').value + ' JD - ' + document.getElementById('rangeMax').value + ' JD';

        // Update the track styling
        const rangeTrack = document.getElementById('rangeTrack');
        const percentMin = ((document.getElementById('rangeMin').value - min) / (max - min)) * 100;
        const percentMax = ((document.getElementById('rangeMax').value - min) / (max - min)) * 100;
        rangeTrack.style.left = percentMin + '%';
        rangeTrack.style.width = (percentMax - percentMin) + '%';
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateRange();
    });
</script>
@endsection
