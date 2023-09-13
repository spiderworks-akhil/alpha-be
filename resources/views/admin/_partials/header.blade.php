<div class="left-sidenav">
            <!-- LOGO -->
            <div class="brand">
                <a href="{{route('admin.dashboard')}}" class="logo">
                    <span>
                        <img src="{{asset($common_settings['logo'])}}" alt="logo-small" class="logo-sm" style="width: 90%;">
                    </span>
                    
                </a>
            </div>
            
            
            <!--end logo-->
            <div class="menu-content h-100" data-simplebar>
                <ul class="metismenu left-sidenav-menu">
                    <x-admin-menu />   
                </ul>
    
                
            </div>
        </div>