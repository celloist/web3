<div class="sticky">
<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="#">My Site</a></h1>
        </li>
        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
            <li class="has-form">
                <div class="row collapse">
                    <div class="large-8 small-9 columns">
                        <input type="text" placeholder="Find Stuff">
                    </div>
                    <div class="large-4 small-3 columns">
                        <a href="#" class="alert button expand">Search</a>
                    </div>
                </div>
            </li>

        </ul>

        <!-- Left Nav Section -->
        <ul class="left">
            <li class="active"><a href="#">Right Button Active</a></li>
            <li class="has-dropdown">
                <a href="#">Right Button Dropdown</a>
                <ul class="dropdown">
                    @foreach ($menus as $menu)
                        <li><a href="{{$menu->link}}">{{$menu->name}}</a></li>
                    @endforeach
                    <li><a href="#">First link in dropdown</a></li>
                    <li class="active"><a href="#">Active link in dropdown</a></li>
                </ul>
            </li>
        </ul>
    </section>
</nav>
</div>