<div class="sticky">
<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="{{url('categories')}}">GoldenFingers</a></h1>
        </li>
        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
        <!-- Right Nav Section -->

        <!-- Left Nav Section -->
        <ul class="left">
            @foreach ($menus as $menu)
                <li><a href="{{url($menu->link)}}">{{$menu->name}}</a></li>
            @endforeach
        </ul>
        </li>
        </ul>

        <ul class="right">
            <li class="has-form">
                <div class="row collapse">
                    <div class="large-8 small-9 columns">
                        <input type="text" placeholder="Products">
                    </div>
                    <div class="large-4 small-3 columns">
                        <a href="#" class="alert button expand">Search</a>
                    </div>
                </div>
            </li>

        </ul>



    </section>
</nav>
    {!! Breadcrumbs::renderIfExists() !!}

</div>