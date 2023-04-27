<div class="container-fluid page-body-wrapper">
       <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a style="color: white; padding-left: 20px;" href="{{url('/redirect')}}">Admin</a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              
             
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="{{asset('/face.jpg')}}" alt="">
                    <p  class="mb-0 d-none d-sm-block navbar-profile-name">Admin</p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                  
                    
                  </a>
                  <div class="dropdown-divider"></div>
                 
                    
                     
                         
                               <form method="POST" action="{{ route('logout') }}">
                          @csrf
                         
                              <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                          this.closest('form').submit(); " role="button">
                                  

                                  {{ __('Log Out') }}
                              </a>
                          
                      </form>
                 
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>