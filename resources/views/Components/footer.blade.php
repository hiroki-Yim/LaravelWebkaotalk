<nav class="tab-bar">
    <a href="{{url('/')}}" class="tab-bar__tab tab-bar__tab--selected" id="tab-bar__index">
        <i class="fa fa-user"></i>
        <span class="tab-bar__title">Friends</span>
    </a>
    <a href="{{url('chats')}}" class="tab-bar__tab" id="tab-bar__chats">
        <i class="fa fa-comment"></i>
        <span class="tab-bar__title">Chats</span>
    </a>
    <a href="{{route('board.index')}}" class="tab-bar__tab" id="tab-bar__board">
        <!-- get방식이라 route로 route리스트에 있는 name값으로 접근 -->
        <i class="fas fa-clipboard-list"></i>
        <span class="tab-bar__title">board</span>
    </a>
    <a href="{{url('Friend')}}" class="tab-bar__tab" id="tab-bar__find">
        <i class="fa fa-search"></i>
        <span class="tab-bar__title">Friends</span>
    </a>
    <a href="{{url('more')}}" class="tab-bar__tab" id="tab-bar__more">
        <i class="fa fa-ellipsis-h"></i>
        <span class="tab-bar__title">More</span>
    </a>
</nav>
