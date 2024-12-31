<x-mary-nav sticky full-width class='nav'>
    <x-slot:brand>
        {{-- Drawer toggle for the sidebar (only visible on smaller screens) --}}
        <span id="sidebarToggleContainer"></span>
        <label for="main-drawer" class="mr-3 lg:hidden">
            <x-mary-icon name="o-bars-3" class="cursor-pointer" />
        </label>

        {{-- Brand Logo --}}
        <div class="flex items-center justify-center">
            <div class="flex items-center justify-center py-0">
                {{-- Light Logo --}}
                <img src="{{ asset('assets/images/logos/demo_logo.jpg') }}"
                     alt="Rocket Learning Light Logo" class="h-12 brand-logo w-30 dark:hidden">
            </div>
        </div>
    </x-slot:brand>
    {{-- Actions Section --}}
    <x-slot:actions>
        <x-mary-dropdown>
            <x-slot:trigger>
                <x-mary-button icon="o-user" class="btn btn-circle btn-outline" />
            </x-slot:trigger>
            {{-- Menu Items --}}
            <x-mary-menu-item link="" icon="o-user" title="Edit Profile" class="hover:bg-primary hover:text-primary-content" />
            <x-mary-menu-item icon="o-power" title="Logout" class="hover:bg-primary hover:text-primary-content" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"/>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </x-mary-dropdown>
    </x-slot:actions>
</x-mary-nav>
