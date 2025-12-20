<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('admin.index') }}" class="sidebar-logo">
            <img src="{{ asset('storage/' . ($settings->site_favicon ?? 'default-favicon.png')) }}" alt="site logo"
                class="light-logo">
            <img src="{{ asset('storage/' . ($settings->site_favicon ?? 'default-favicon.png')) }}" alt="site logo"
                class="dark-logo">
            <img src="{{ asset('storage/' . ($settings->site_favicon ?? 'default-favicon.png')) }}" alt="site logo"
                class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">

            {{-- Dashboard --}}
            <li>
                <a href="{{ route('admin.index') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- Banners --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:image-outline" class="menu-icon"></iconify-icon>
                    <span>Banners</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.banners.index') }}">
                            <iconify-icon icon="ri:list-unordered" class="circle-icon text-primary-600"></iconify-icon>
                            Banner List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.banners.create') }}">
                            <iconify-icon icon="mdi:plus-circle-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Add Banner
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Products --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:package-variant-closed" class="menu-icon"></iconify-icon>
                    <span>Products</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.products.index') }}">
                            <iconify-icon icon="ri:list-unordered" class="circle-icon text-primary-600"></iconify-icon>
                            Product List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.create') }}">
                            <iconify-icon icon="mdi:package-variant-closed" class="menu-icon"></iconify-icon>
                            Add Product
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Categories --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:shape-outline" class="menu-icon"></iconify-icon>
                    <span>Categories</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.categories.index') }}">
                            <iconify-icon icon="ri:list-unordered" class="circle-icon text-primary-600"></iconify-icon>
                            Category List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.create') }}">
                            <iconify-icon icon="mdi:plus-circle-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Add Category
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Sizes --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:ruler" class="menu-icon"></iconify-icon>
                    <span>Sizes</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.sizes.index') }}">
                            <iconify-icon icon="ri:list-unordered" class="circle-icon text-primary-600"></iconify-icon>
                            Size List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sizes.create') }}">
                            <iconify-icon icon="mdi:plus-circle-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Add Size
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Colors --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:palette-outline" class="menu-icon"></iconify-icon>
                    <span>Colors</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.colors.index') }}">
                            <iconify-icon icon="ri:list-unordered" class="circle-icon text-primary-600"></iconify-icon>
                            Color List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.colors.create') }}">
                            <iconify-icon icon="mdi:plus-circle-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Add Color
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Orders --}}
            <li>
                <a href="{{ route('admin.orders.index') }}">
                    <iconify-icon icon="mdi:clipboard-list-outline" class="menu-icon"></iconify-icon>
                    <span>Orders</span>
                </a>
            </li>
            {{-- contacts --}}
            <li>
                <a href="{{ route('admin.contacts.index') }}">
                    <iconify-icon icon="mdi:clipboard-list-outline" class="menu-icon"></iconify-icon>
                    <span>contacts</span>
                </a>
            </li>
            {{-- wholesales --}}
            <li>
                <a href="{{ route('admin.wholesales.index') }}">
                    <iconify-icon icon="mdi:clipboard-list-outline" class="menu-icon"></iconify-icon>
                    <span>wholesales</span>
                </a>
            </li>

            {{-- Coupons --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:ticket-percent-outline" class="menu-icon"></iconify-icon>
                    <span>Coupons</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.coupons.index') }}">
                            <iconify-icon icon="ri:list-unordered" class="circle-icon text-primary-600"></iconify-icon>
                            Coupon List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.coupons.create') }}">
                            <iconify-icon icon="mdi:plus-circle-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Add Coupon
                        </a>
                    </li>
                </ul>
            </li>

            {{-- FAQs --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:help-circle-outline" class="menu-icon"></iconify-icon>
                    <span>FAQs</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.faqs.index') }}">
                            <iconify-icon icon="ri:list-unordered"
                                class="circle-icon text-primary-600"></iconify-icon>
                            FAQ List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.faqs.create') }}">
                            <iconify-icon icon="mdi:plus-circle-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Add FAQ
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Carts --}}
            {{-- <li>
                <a href="{{ route('admin.carts.index') }}">
                    <iconify-icon icon="mdi:cart-outline" class="menu-icon"></iconify-icon>
                    <span>Carts</span>
                </a>
            </li> --}}

            {{-- Settings --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:cog-outline" class="menu-icon"></iconify-icon>
                    <span>Settings</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.settings.index') }}">
                            <iconify-icon icon="mdi:tune-vertical"
                                class="circle-icon text-primary-600"></iconify-icon>
                            General Settings
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</aside>
