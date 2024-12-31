<x-slot:sidebar drawer="main-drawer" class="sidebar scrollbar-hidden bg-base-100" x-data="{
    temp: '',
    closeSidebar() {
        document.getElementById('main-drawer').checked = false;
    },
    init() {
        this.handleResize();
        window.addEventListener('resize', this.handleResize);
    },
    handleResize() {
        if (window.innerWidth < 1024 && collapsed) {
            collapsed = false;
        }
    },
    destroy() {
        window.removeEventListener('resize', this.handleResize);
    }
}"
                x-init="init()" x-on:destroy="destroy()">
    {{--  sidebar hamburger  --}}
    <div :class="{ 'collapsed': collapsed }">
        <div class="justify-end hidden px-4 pt-4 max-lg:flex">
            <x-mary-button icon="o-x-mark" @click="closeSidebar" class="px-1 rounded-md cursor-pointer btn-ghost btn-sm"/>
        </div>
        {{-- MENU --}}
        <x-mary-menu activate-by-route>
            <x-mary-menu-item @click="toggle" title="" class="hidden mr-2 cursor-pointer" id="sidebarToggleElement"
                         wire:ignore>
                <x-mary-icon x-show="collapsed" name="o-bars-3" />
                <x-mary-icon x-show="!collapsed" name="o-chevron-double-left" />
            </x-mary-menu-item>
            <x-mary-menu-item title="Home" icon="o-home" link="" />
            <x-mary-menu-sub title="Users" icon="o-user" >
                <x-mary-menu-item title="Browse User" icon="o-document-text" link="" />
            </x-mary-menu-sub>
        </x-mary-menu>
    </div>
</x-slot:sidebar>

