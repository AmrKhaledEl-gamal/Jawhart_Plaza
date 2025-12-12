    @extends('front.layouts.app')
    @section('content')
        <main class ="innerPage">

            <header>
                <span class="heroOverlay"><img src="{{ asset('front/images/innerPageBanner.png') }}" alt="banner"></span>
                <h1 class="intro underline" data-aos="zoom-in-up"> الاصناف والمنتجات</h1>
            </header>

            <section class="productFilter">
                <div class="container">

                    <article class="filter" data-aos="fade-up">
                        <form class="filterOptions" method="GET">

                            <div class="filterWrapper">
                                <h3>التصنيف :</h3>
                                <ul>

                                    @foreach ($categories as $category)
                                        <li class="filterOption">
                                            <input type="checkbox" name="categories" id="cat_{{ $category->id }}"
                                                value="{{ $category->id }}"
                                                {{ request('categories') == $category->id ? 'checked' : '' }}>

                                            <label for="cat_{{ $category->id }}"> {{ $category->name }} </label>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>

                            <button type="submit" class="readMore">فــلــتــرة المنتجات</button>
                        </form>
                    </article>

                    <article class="productGrid">

                        <form class="searchEngine" method="GET" data-aos="fade-down" data-aos-delay="300">

                            <div class="inputHolder">
                                <label for="productSearcher"><i class="fa-solid fa-magnifying-glass"></i></label>

                                <input type="text" name="searchFilter" id="productSearcher"
                                    placeholder="ابحث عن اسم المنتج ..." value="{{ request('searchFilter') }}">
                            </div>

                            <button type="submit" class="readMore">البحث عن المنتج</button>
                        </form>

                        <div id="allProducts" data-aos="fade-up" data-aos-delay="500">

                            @forelse ($products as $product)
                                <article>
                                    <img src="{{ $product->getFirstMediaUrl('products') ?: asset('front/images/product1.png') }}"
                                        alt="{{ $product->title }}" />

                                    <h3 class="productName">{{ $product->title }}</h3>
                                </article>
                            @empty
                                <p style="text-align:center">لا توجد منتجات</p>
                            @endforelse

                        </div>

                        <div id="productList">
                            @foreach ($products as $product)
                                <div class="productItem">
                                    <h3>{{ $product->name }}</h3>
                                    <p>{{ $product->description }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div id="productPagination">
                            <div id="paginationBtns">
                                {{-- Previous Button --}}
                                @if ($products->onFirstPage())
                                    <button id="prev" disabled type="button"><i
                                            class="fa-solid fa-angles-right"></i></button>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}">
                                        <button id="prev" type="button"><i
                                                class="fa-solid fa-angles-right"></i></button>
                                    </a>
                                @endif

                                {{-- Page Numbers --}}
                                <span id="paginationNumbers">
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        @if ($page == $products->currentPage())
                                            <button class="active" disabled>{{ $page }}</button>
                                        @else
                                            <a href="{{ $url }}"><button>{{ $page }}</button></a>
                                        @endif
                                    @endforeach
                                </span>

                                {{-- Next Button --}}
                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}">
                                        <button id="next" type="button"><i
                                                class="fa-solid fa-angles-left"></i></button>
                                    </a>
                                @else
                                    <button id="next" disabled type="button"><i
                                            class="fa-solid fa-angles-left"></i></button>
                                @endif
                            </div>

                            <div id="productAmount">
                                إجمالي المنتجات: {{ $products->total() }}
                            </div>
                        </div>

                    </article>

                </div>
            </section>
        </main>
    @endsection
