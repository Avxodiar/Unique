<ul class="nav navbar-nav" id="mainNav">
    @if( !empty($menu) && is_array($menu))
        @foreach($menu as $alias => $title)
            <li @if($alias === 'home') class="active" @endif>
                <a href="#{{ $alias }}" class="scroll-link">
                    {{ $title }}
                </a>
            </li>
        @endforeach
    @endif
</ul>
