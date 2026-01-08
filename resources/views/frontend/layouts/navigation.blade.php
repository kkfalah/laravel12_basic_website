<nav class="main-menu menu-style1 d-none d-lg-block menu-left">
    <ul>
        <li>
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="menu-item-has-children">
            <a href="{{ route('about') }}">About Us</a>
            <ul class="sub-menu">
                <li><a href="{{ route('team') }}">Team</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('blog') }}">Blog</a>
        </li>
        <li>
            <a href="{{ route('contact') }}">Contact</a>
        </li>
    </ul>
</nav>
