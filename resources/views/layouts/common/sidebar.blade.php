<aside id="left-panel">
    
    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as is -->
            
            <a href="javascript:;" id="show-shortcut" data-action="toggleShortcut" >
                <img src="img/avatars/sunny.png" alt="me" class="online" />
                <span>
                    {{ Auth::user()->first_name }}
                </span>
                <!-- <i class="fa fa-angle-down"></i> -->
            </a>
            
        </span>
    </div>
    
    <nav>
        <ul>
            @foreach (config("ctrl.menu") as $menu => $info)
            <li   @if ($active_menu == $menu) class="active" @endif >
                @if (count($info['child']) == count($info['child'], COUNT_RECURSIVE)) 
                   
                    <a href='{{route($info["url"])}}'>
                        <i class="fa fa-lg fa-fw {{$info['icon']}}"></i>
                        <span class="menu-item-parent">{{ trans('lang.' .$menu) }}</span>
                    </a>
                  
                @else
                <li  @if(in_array($active_menu, array_keys($info['child'])) ) class="active" @endif>
                    <a href='#'><i class="fa fa-lg fa-fw {{$info['icon']}}"></i> <span class="menu-item-parent">{{ trans('lang.' .$menu) }}</span></a>
                    <ul>
                        @foreach ($info['child'] as $menu_item => $info_item)
                            @permission($info_item['visible-to-permissions'])
                            <li @if(Request::path() == $menu_item) class="active" @endif>
                                <a href='{{route($info_item["url"])}}'>{{ trans('lang.' . $menu_item) }}</a>
                            </li>
                            @endpermission
                        @endforeach
                    </ul>
                </li>
                @endif
            </li>
            @endforeach
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
</aside>