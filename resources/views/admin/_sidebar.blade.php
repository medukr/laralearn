<ul class="sidebar-menu">
    <li class="header">@lang('sidebar.main_navigation')</li>
    <li class="treeview">
        <a href="/admin">
            <i class="fa fa-dashboard"></i> <span>@lang('sidebar.admin_panel')</span>
        </a>
    </li>
    <li><a href="{{ route('posts.index') }}"><i class="fa fa-sticky-note-o"></i> <span>@lang('sidebar.posts')</span></a></li>
    <li><a href="{{ route('categories.index') }}"><i class="fa fa-list-ul"></i> <span>@lang('sidebar.categories')</span></a></li>
    <li><a href="{{ route('tags.index') }}"><i class="fa fa-tags"></i> <span>@lang('sidebar.tags')</span></a></li>
    <li>
        <a href="/admin/comments">
            <i class="fa fa-commenting"></i> <span>@lang('sidebar.comments')</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$countComments}}</small>
            </span>
        </a>
    </li>
    <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>@lang('sidebar.users')</span></a></li>
    <li><a href="{{route('subscribers.index')}}"><i class="fa fa-user-plus"></i> <span>@lang('sidebar.subscriptions')</span></a></li>

</ul>
