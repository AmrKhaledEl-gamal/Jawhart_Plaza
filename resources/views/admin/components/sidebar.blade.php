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
                    <span>لوحة التحكم</span>
                </a>
            </li>




            {{-- Banners --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:image-outline" class="menu-icon"></iconify-icon>
                    <span>البنرات</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.banners.index') }}">
                            <iconify-icon icon="ri:list-unordered" class="circle-icon text-primary-600"></iconify-icon>
                            قائمة البنرات
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.banners.create') }}">
                            <iconify-icon icon="mdi:plus-circle-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            إضافة بنر
                        </a>
                    </li>
                </ul>
            </li>

            {{-- products --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:package-variant-closed" class="menu-icon"></iconify-icon>
                    <span>المنتجات</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.products.index') }}">
                            <iconify-icon icon="ri:list-unordered" class="circle-icon text-primary-600"></iconify-icon>
                            قائمة المنتجات
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.create') }}">
                            <iconify-icon icon="mdi:package-variant-closed" class="menu-icon"></iconify-icon>
                            إضافة منتج
                        </a>
                    </li>
                </ul>
            </li>
            {{-- Categories --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:shape-outline" class="menu-icon"></iconify-icon>
                    <span> التصنيفات</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.categories.index') }}">
                            <iconify-icon icon="ri:list-unordered" class="circle-icon text-primary-600"></iconify-icon>
                            قائمة التصنيفات
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.create') }}">
                            <iconify-icon icon="mdi:plus-circle-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            إضافة تصنيف
                        </a>
                    </li>
                </ul>
            </li>
            {{-- {jobs} --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:briefcase-outline" class="menu-icon"></iconify-icon>
                    <span> الوظائف</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.jobs.index') }}">
                            <iconify-icon icon="ri:list-unordered" class="circle-icon text-primary-600"></iconify-icon>
                            قائمة الوظائف
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jobs.create') }}">
                            <iconify-icon icon="mdi:plus-circle-outline"
                                class="circle-icon text-primary-600"></iconify-icon>
                            إضافة وظيفة
                        </a>
                    </li>
                </ul>
            </li>


            {{-- Contacts --}}
            <li>
                <a href="{{ route('admin.contacts.index') }}">
                    <iconify-icon icon="mdi:phone-outline" class="menu-icon"></iconify-icon>
                    <span>طلبات التواصل</span>
                </a>
            </li>
            {{-- job application --}}
            <li>
                <a href="{{ route('admin.applications.index') }}">
                    <iconify-icon icon="mdi:file-document-outline" class="menu-icon"></iconify-icon>
                    <span> طلبات التوظيف</span>
                </a>
            </li>
            {{-- About --}}
            <li>
                <a href="{{ route('admin.about.edit') }}">
                    <iconify-icon icon="mdi:information-outline" class="menu-icon"></iconify-icon>
                    <span> من نحن</span>
                </a>
            </li>



            {{-- Settings --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:cog-outline" class="menu-icon"></iconify-icon>
                    <span>الإعدادات</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.settings.index') }}">
                            <iconify-icon icon="mdi:tune-vertical" class="circle-icon text-primary-600"></iconify-icon>
                            الاعدادات العامة
                        </a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</aside>
