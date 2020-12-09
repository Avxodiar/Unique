<ul class="nav navbar-nav" id="mainNav">
    @if( !empty($menuList) && is_array($menuList))
        @foreach($menuList as $alias => $title)
            <li @if($alias === 'home') class="active" @endif>
                <a href="#{{ $alias }}" class="scroll-link">
                    {{ $title }}
                </a>
            </li>
        @endforeach
    @endif
</ul>
