<aside class="sidebar">
    <button type="button" class="sidebar-close-btn" aria-label="Close Sidebar">
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
                <a href="{{ route('admin.index') }}" aria-label="Dashboard">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-menu-group-title">Menu</li>

            {{-- Catalog Management Group --}}
            <li class="dropdown">
                <a href="javascript:void(0)" aria-expanded="false" aria-controls="catalog-submenu">
                    <iconify-icon icon="mdi:store-outline" class="menu-icon"></iconify-icon>
                    <span>Catalog Management</span>
                </a>
                <ul class="sidebar-submenu" id="catalog-submenu">
                    <li>
                        <a href="{{ route('admin.categories.index') }}">
                            <iconify-icon icon="mdi:shape-outline" class="circle-icon text-primary-600"></iconify-icon>
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}">
                            <iconify-icon icon="mdi:package-variant-closed"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sizes.index') }}">
                            <iconify-icon icon="mdi:ruler" class="circle-icon text-primary-600"></iconify-icon>
                            Sizes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.colors.index') }}">
                            <iconify-icon icon="mdi:palette-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Colors
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.banners.index') }}">
                            <iconify-icon icon="mdi:image-outline" class="circle-icon text-primary-600"></iconify-icon>
                            Banners
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Sales & Operations Group --}}
            <li class="dropdown">
                <a href="javascript:void(0)" aria-expanded="false" aria-controls="sales-submenu">
                    <iconify-icon icon="mdi:cart-outline" class="menu-icon"></iconify-icon>
                    <span>Sales & Operations</span>
                </a>
                <ul class="sidebar-submenu" id="sales-submenu">
                    <li>
                        <a href="{{ route('admin.orders.index') }}">
                            <iconify-icon icon="mdi:clipboard-list-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.wholesales.index') }}">
                            <iconify-icon icon="mdi:handshake-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Wholesale Requests
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.coupons.index') }}">
                            <iconify-icon icon="mdi:ticket-percent-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            Coupons
                        </a>
                    </li>
                </ul>
            </li>

            {{-- System & Support Group --}}
            <li class="dropdown">
                <a href="javascript:void(0)" aria-expanded="false" aria-controls="support-submenu">
                    <iconify-icon icon="mdi:cog-outline" class="menu-icon"></iconify-icon>
                    <span>System & Support</span>
                </a>
                <ul class="sidebar-submenu" id="support-submenu">
                    <li>
                        <a href="{{ route('admin.contacts.index') }}">
                            <iconify-icon icon="mdi:email-outline" class="circle-icon text-primary-600"></iconify-icon>
                            Contact Messages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.faqs.index') }}">
                            <iconify-icon icon="mdi:help-circle-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            FAQs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.index') }}">
                            <iconify-icon icon="mdi:tune-vertical" class="circle-icon text-primary-600"></iconify-icon>
                            General Settings
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</aside>
