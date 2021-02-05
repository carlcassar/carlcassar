<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}
    </a>
</li>

<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('article') }}'>
        <i class='nav-icon la la-newspaper'></i>
        Articles
    </a>
</li>

<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('tag') }}'>
        <i class='nav-icon la la-tags'></i>
        Tags
    </a>
</li>
