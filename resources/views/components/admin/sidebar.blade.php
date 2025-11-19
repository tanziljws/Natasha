<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>

    <div>
        <a href="{{ url('/') }}" class="sidebar-logo" target="_blank">
            <img src="{{ asset('storage/' . ui_value('web-setting', 'logo')) }}" alt="site logo" class="light-logo">
            <img src="{{ asset('storage/' . ui_value('web-setting', 'logo_white')) }}" alt="site logo"
                class="dark-logo">
            <img src="{{ asset('storage/' . ui_value('web-setting', 'icon')) }}" alt="site icon" class="logo-icon">
        </a>
    </div>

    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">

            {{-- Dashboard --}}
            <li>
                <a href="{{ route('admin.dashboard.index') }}">
                    <iconify-icon icon="mdi:view-dashboard-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>


            {{-- Profiles --}}
            @can('admin.profiles.index')
            <li>
                <a href="{{ route('admin.profiles.index') }}">
                    <iconify-icon icon="mdi:account-group-outline" class="menu-icon"></iconify-icon>
                    <span>Profiles</span>
                </a>
            </li>
            @endcan

            {{-- Majors --}}
            @can('admin.major.index')
            <li>
                <a href="{{ route('admin.major.index') }}">
                    <iconify-icon icon="mdi:book-outline" class="menu-icon"></iconify-icon>
                    <span>Major</span>
                </a>
            </li>
            @endcan


            @can('admin.post.index')
            <li>
                <a href="{{ route('admin.post.index') }}">
                    <iconify-icon icon="mdi:post-outline" class="menu-icon"></iconify-icon>
                    <span>Posts</span>
                </a>
            </li>
            @endcan
            @can('admin.galery.index')
            <li>
                <a href="{{ route('admin.galery.index') }}">
                    <iconify-icon icon="mdi:image-multiple-outline" class="menu-icon"></iconify-icon>
                    <span>Galery</span>
                </a>
            </li>
            @endcan
            @can('admin.category.index')
            <li>
                <a href="{{ route('admin.category.index') }}">
                    <iconify-icon icon="mdi:label-outline" class="menu-icon"></iconify-icon>
                    <span>Kategori</span>
                </a>
            </li>
            @endcan






            {{-- UI Config --}}
            @php
            $cUiConfigGroup = app(App\Models\UiConfigGroup::class)
            ->whereHas('configs')
            ->orderBy('order')
            ->get(['title', 'slug', 'id']);
            @endphp
            @if (auth()->user()->canAny(['admin.ui-config-group.index', 'admin.ui-config.index']))
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:cog-outline" class="menu-icon"></iconify-icon>
                    <span>Pengaturan</span>
                </a>
                <ul class="sidebar-submenu">
                    @can('admin.ui-config-group.index')
                    <li>
                        <a href="{{ route('admin.ui-config-group.index') }}">
                            <iconify-icon icon="mdi:folder-cog-outline" class="menu-icon"></iconify-icon>
                            <span>Config Groups</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a href="{{ route('admin.ui-config.index') }}">
                            <iconify-icon icon="mdi:format-list-checks" class="menu-icon"></iconify-icon>
                            <span>Config Items</span>
                        </a>
                    </li>
                    @can('admin.ui-config.index')

                    @foreach ($cUiConfigGroup as $item)
                    <li>
                        <a href="{{ route('admin.ui-config.show', $item->slug) }}">
                            <iconify-icon icon="mdi:cog" class="menu-icon"></iconify-icon>
                            <span>{{ $item->title }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endcan
                </ul>
            </li>
            @endif

            {{-- User & Role --}}
            @if (auth()->user()->canAny(['admin.user.index', 'admin.role.index']))
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:account-group" class="menu-icon"></iconify-icon>
                    <span>User & Role</span>
                </a>
                <ul class="sidebar-submenu">
                    @can('admin.user.index')
                    <li>
                        <a href="{{ route('admin.user.index') }}">
                            <iconify-icon icon="mdi:account-multiple" class="menu-icon"></iconify-icon>
                            <span>Kelola User</span>
                        </a>
                    </li>
                    @endcan
                    @can('admin.role.index')
                    <li>
                        <a href="{{ route('admin.role.index') }}">
                            <iconify-icon icon="mdi:account-key" class="menu-icon"></iconify-icon>
                            <span>Kelola Role</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif


        </ul>
    </div>
</aside>