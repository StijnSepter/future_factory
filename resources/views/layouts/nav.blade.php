<header x-data="{ openNav: false }"
        :class="{'bg-white': openNav === true }"
        class="header">
    <div class="container">
        <nav class="nav">
            <div class="nav-left">
                <img
                    src="{{ Storage::url('assets/future_factory_logo.png') }}"
                    alt="logo"
                    class="logo"
                />
                <a href="{{url('#')}}" class="site-title">Future Factory</a>
            </div>

            <div class="mobile-menu-btn">
                <button @click="openNav = !openNav" class="menu-button">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="menu-icon">
                        <path x-show="!openNav" fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0..."
                            clip-rule="evenodd"></path>

                        <path x-show="openNav" fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293..."
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div :class="{'hidden': openNav === false }"
                 class="nav-links">
                <a href="{{url('/')}}" class="nav-link">Home</a>
                <a href="{{url('/')}}" class="nav-link">Send Bulk Email</a>
                <a href="{{url('/')}}" class="nav-link">Add New Email</a>
            </div>
        </nav>
    </div>
</header>