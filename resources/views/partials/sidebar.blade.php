@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title"></span>
                </a>
            </li>




            <li class="{{ $request->segment(2) == 'teams' ? 'active' : '' }}">
                <a href="{{ route('teams.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title"></span>
                </a>
            </li>





            <li class="{{ $request->segment(2) == 'games' ? 'active' : '' }}">
                <a href="{{ route('games.index') }}">
                    <i class="fa fa-soccer-ball-o"></i>
                    <span class="title"></span>
                </a>
            </li>









        </ul>
    </section>
</aside>

