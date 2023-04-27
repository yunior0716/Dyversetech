 <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a style="color: white;"  href="{{url('/redirect')}}">Admin</a>
          
        </div>
        <ul class="nav">
          <li class="nav-item profile">
             
              
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>


          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('/redirect')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>




          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>


              <span class="menu-title">Products</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{url('/view_product')}}">Add Products</a></li>


                <li class="nav-item">

                 <a class="nav-link" href="{{url('/show_product')}}">Show Product</a>


               </li>
                
              </ul>
            </div>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('view_catagory')}}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Catagory</span>
            </a>
          </li>


          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('view_brand')}}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Brand</span>
            </a>
          </li>


          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('view_model')}}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Models</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('view_operator')}}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Operators</span>
            </a>
          </li>





          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('order')}}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Order</span>
            </a>
          </li>


           <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('message')}}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Messages</span>
            </a>
          </li>


          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('customer')}}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">All Customers</span>
            </a>
          </li>

         
        </ul>
      </nav>