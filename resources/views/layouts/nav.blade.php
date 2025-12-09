<header x-data="{ openNav: false }"
        :class="{'bg-white shadow-lg': openNav === true }"
        class="sticky top-0 z-50 bg-gray-800 text-white shadow-md">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center justify-between h-16">
            <div class="flex items-center space-x-3 nav-left">
                <img
                    src="{{ Storage::url('assets/future_factory_logo.png') }}"
                    alt="logo"
                    class="h-8 w-auto logo"
                />
                <a href="{{url('#')}}" class="site-title text-xl font-bold tracking-wider hover:text-indigo-400 transition duration-300">
                    Future Factory
                </a>
            </div>

            <div class="flex md:hidden mobile-menu-btn">
                <button @click="openNav = !openNav" class="menu-button p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="menu-icon h-6 w-6">
                       <path x-show="!openNav" fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0..."
                            clip-rule="evenodd"></path> 
                        <path x-show="openNav" fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="hidden md:flex md:space-x-4 nav-links">
                <a href="{{url('/')}}" class="nav-link px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition duration-300">Dashboard</a>
                <a href="{{url('/')}}" class="nav-link px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition duration-300">Agenda</a>
                <a href="{{url('/')}}" class="nav-link px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition duration-300">Voertuigassemblage</a>
            </div>
        </nav>
    </div>

    <div x-show="openNav"
         x-transition:enter="duration-200 ease-out"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="duration-100 ease-in"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="md:hidden nav-links bg-gray-700 absolute w-full pb-3"
         @click.away="openNav = false"
    >
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 flex flex-col">
            <a href="{{url('/')}}" class="nav-link block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">Dashboard</a>
            <a href="{{url('/')}}" class="nav-link block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">Agenda</a>
            <a href="{{url('/')}}" class="nav-link block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-600 transition duration-300">Voertuigassemblage</a>
        </div>
    </div>
</header>