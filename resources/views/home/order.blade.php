<!DOCTYPE html>
<html>
   <head>
    

     <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    @include('home.css')

   </head>

   <body>

      @include('sweetalert::alert')
   <div class="hero_area">
         <!-- header section strats -->
       @include('home.header')
         

      <main id="main">
         <section class="section cart__area">
             <div class="container">
                 <div class="responsive__cart-area">
                     <form class="cart__form">
                         <div class="cart__table table-responsive">
                             <table width="100%" class="table">
                                 <thead>
                                     <tr>
                                         <th>Product Title</th>
                                         <th>Quantity</th>
                                         <th>Price</th>
                                         <th>Payment Status</th>
                                         <th>Delivery Status</th>
                                         <th>Image</th>
                                         <th>Cancel Order</th>
                                     </tr>
                                 </thead>
                     
                                   @foreach($order as $order)


                                 <tbody>
                                     <tr>

                                          <td class="product__name">
                                             <a href="#">{{$order->product_title}}</a>
                                          </td>

                                          <td class="product__quantity">
                                             <div class="input-counter">
                                                {{$order->quantity}}
                                             </div>
                                         </td>

                                         <td class="product__price">
                                          <div class="price">
                                              <span class="new__price">${{$order->price}}</span>
                                          </div>
                                      </td>

                                      <td class="product__name">
                                       <a href="#">{{$order->payment_status}}</a>
                                   </td>

                                   <td class="product__name">
                                    <a href="#">{{$order->delivery_status}}</a>
                                </td>

                                 <td class="product__thumbnail">
                                          <img class="img_deg" src="product/{{$order->image}}">
                                 </td>


                                 <td class="product__name">
                                    @if($order->delivery_status=='processing')

                                    <a onclick="confirmation(event)" class="btn btn-danger" href="{{url('cancel_order',$order->id)}}">Cancel Order</a>
               
               
                                    @else
               
                                    <p style="color: blue;">Not Allowed</p>
               
                                    @endif

                                 </td>
                              </tr>  
                         </tbody>

                                @endforeach
                            

                     </table>
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
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
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
   </body>



</html>