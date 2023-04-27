<!DOCTYPE html>
<html>
   <head>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
      @include('home.css')

   </head>

   <body>
          @include('sweetalert::alert')
 
      <div class="hero_area">/
         <!-- header section strats -->
       @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
       
         <!-- end slider section -->
  
      <!-- why section -->


       
      <main id="main">
         <section class="section cart__area">
             <div class="container">
                 <div class="responsive__cart-area">
                     <form class="cart__form">
                         <div class="cart__table table-responsive">
                             <table width="100%" class="table">
                                 <thead>
                                     <tr>
                                         <th>PRODUCT</th>
                                         <th>NAME</th>
                                         <th>UNIT PRICE</th>
                                         <th>QUANTITY</th>
                                         <th>TOTAL</th>
                                     </tr>
                                 </thead>

                                 <?php $totalprice=0;  ?>

                                 <?php $totalproduct=0;  ?>
                     
                                   @foreach($cart as $cart)


                                 <tbody>
                                     <tr>
                                         <td class="product__thumbnail">
                                                 <img class="img_deg" src="{{asset('/product/'.$cart->image)}}">
                                         </td>

                                         <td class="product__name">
                                             <a href="#">{{$cart->product_title}}</a>
                                         </td>

                                         <td class="product__price">
                                             <div class="price">
                                                 <span class="new__price">${{$cart->product->price}}</span>
                                             </div>
                                         </td>

                                         <td class="product__quantity">
                                             <div class="input-counter">
                                                {{$cart->quantity}}
                                             </div>
                                         </td>

                                         <td class="product__subtotal">
                                             <div class="price">
                                                 <span class="new__price">${{$cart->price}}</span>
                                             </div>

                                             <a class="remove__cart-item" onclick="confirmation(event)" href="{{url('/remove_cart',$cart->id)}}">
                                                 <svg>
                                                     <use xlink:href="./images/sprite.svg#icon-trash"></use>
                                                 </svg>
                                             </a>
                                         </td>
                                     </tr>

                                     
                                </tbody>

                                <?php $totalproduct++; ?>

                                <?php $totalprice=$totalprice + $cart->price ?>
                  
                                @endforeach
                            

                              </table>
                          </div>
  
                          <div class="cart-btns">
                              <div class="continue__shopping">
                                  <a href="/products">Continue Shopping</a>
                              </div>
                          </div>
  
                          <div class="cart__totals">
                              <h3>Cart Totals</h3>
                              <ul>
                                  <li>
                                      Total
                                      <span class="new__price">${{$totalprice}}</span>
                                  </li>
                              </ul>


                              <h1 style="font-size: 25px; padding-bottom: 5%;">Proceed to Order</h1>

                              <div style="padding-bottom: 10%;">
                              <a  href="{{url('cash_order',$totalproduct)}}" class="">Cash On Delivery</a>
                              </div>
                  
                              <div>
                              <a href="{{url('stripe',$totalprice)}}" class="">Pay Using Card</a>
                           </div>
            
                          </div>
                      </form>
                  </div>
              </div>
          </section>
      </main>


               
    

      <!-- footer start -->
     
      <!-- footer end -->

      <div style="padding-top: 215px;">
         <div class="cpy_" >
         <p class="mx-auto">© 2023 All Rights Reserved</p>
      </div>

   </div>



   <script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure to cancel this product",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {


                 
                window.location.href = urlToRedirect;
               
            }  


        });

        
    }
</script>



      <!-- jQery -->
            <!-- jQery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>



          <!-- Glide Carousel Script -->
    <script src="node_modules/@glidejs/glide/dist/glide.min.js"></script>

    <!-- Animate On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom JavaScript -->
    <script src="../js/products.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/slider.js"></script>





   </body>
</html>