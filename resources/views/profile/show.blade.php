<!DOCTYPE html>
<html>
   <head>
      

      @include('home.css')

   

   </head>
   <body>

    @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->

         <header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{url('/')}}"><img width="250" src="{{asset('/images/logo.png')}}" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item ">
                           <a class="nav-link" href="{{url('/')}}">Home  </a>
                        </li>
                       
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('products')}}">Products</a>
                        </li>
                       
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('contact')}}">Contact</a>
                        </li>

                       
                        
                      @if (Route::has('login'))

                        @auth

                        <li class="nav-item">
                           <a class="nav-link"  style="background-color: skyblue; " href="{{url('show_cart')}}">Cart [ <span style="color: green;">{{App\Models\Cart::where('user_id','=',Auth::user()->id)->count()}} ]</span></a>
                        </li>

                        @else

                         <li class="nav-item">
                           <a class="nav-link"  style="background-color: skyblue; " href="{{url('show_cart')}}">Cart [ 0 ]</a>
                        </li>

                       
                        @endauth

                        @endif


                         


                        
                           @auth

                        <li class="nav-item" style="padding-left: 10px!important;
                        padding-right: 10px!important">
                           <a class="nav-link"  style="background-color: lavender; " href="{{url('show_order')}}">Order [ <span style="color: green;">{{App\Models\Order::where('user_id','=',Auth::user()->id)->count()}} ]</span></a>
                        </li>

                        @else

                         <li class="nav-item" style="padding-left: 10px!important;
                        padding-right: 10px!important">
                           <a class="nav-link"  style="background-color: lavender; " href="{{url('show_order')}}">Order [ 0 ]</a>
                        </li>

                       
                        @endauth
                        </li>


                       

                        @if (Route::has('login'))

                        @auth

                       
                  <div class="dropdown">

                    <button style="background-color: #7A838C; border-radius: 8px; font-size: 16px; padding: 10px;" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     {{Auth::user()->name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">



                     <a class="dropdown-item" href="{{ route('profile.show') }}">
                     <span class="btn btn-primary">   {{ __('Profile') }} </span><a/>

                      <form class="dropdown-item"  method="POST" action="{{ route('logout') }}">
                          @csrf
                         
                              <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          this.closest('form').submit(); " role="button">
                                  

                                  {{ __('Log Out') }}
                              </a>
                          
                      </form>

                       
                             
                             
                    </div>

                  </div>
                    
                     
                         
                        
                 
              </li>
            </ul>

                        @else

                        <li class="nav-item">
                           <a class="btn btn-primary" id="logincss" href="{{ route('login') }}">Login</a>
                        </li>

                        <li class="nav-item">
                           <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth

                        @endif
                        
                        
                     </ul>
                  </div>
               </nav>
            </div>
         </header>

 
        <!--  header section ends here -->
     

       <span style="display: none;"> 

       <x-app-layout></x-app-layout>
    
      </span>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>



</div>

<div class="cpy_">
         <p class="mx-auto">© 2023 All Rights Reserved</p>
      </div>
           <!-- jQery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>


</body>


</html>

