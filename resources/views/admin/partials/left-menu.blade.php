<aside class="main-sidebar">

    <section class="sidebar">

        <ul class="sidebar-menu">

            <li class="header">MAIN NAVIGATION</li>

            @foreach($items as $item)

                <li class="{{ isset($left_menu_item) && $left_menu_item == $item['active'] ? 'active' : '' }}">
                    <a href="{{ $item['url'] }}">
                        <i class="{{ $item['icon'] }}"></i> <span>{{ $item['caption'] }}</span>
                    </a>
                </li>

            @endforeach

        </ul>

    </section>

</aside>
