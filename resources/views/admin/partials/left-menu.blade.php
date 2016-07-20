<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ config('site.admin_avatar') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $user->name }}</p>
                <span><i class="fa fa-hashtag text-success"></i> {{ $user->id }}</span>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header text-uppercase">
                {{ trans('dashboard.left-menu.title') }}
            </li>
            @foreach($items as $item)

                <li class="{{ isset($left_menu_item) && $left_menu_item == $item['active'] ? 'active' : '' }}">
                    <a href="{{ $item['url'] }}">
                        <i class="{{ $item['icon'] }}"></i> <span>{{ $item['caption'] }}</span>
                    </a>
                </li>

            @endforeach

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>

                    @foreach($item['settings'] as $setting)
                        {{ dd($setting) }}
                    <li>
                        <a href="{{ $setting['url'] }}"><i class="{{ $setting['icon'] }}"></i> <span>{{ $setting['caption'] }}</span></a>
                    </li>
                    @endforeach
                </ul>
            </li>

            <li class="treeview">
                <a href="{{ route('admin-users-index') }}">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('dashboard.left-menu.administrators') }}</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
