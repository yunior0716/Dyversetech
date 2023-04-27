<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
 
    @include('admin.css')
 <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style type="text/css">
      
      .title_deg
      {

        text-align: center;
        font-size: 25px;
        font-weight: bold;
        padding-bottom: 40px;


      }


      .table_deg
      {
        border: 2px solid white;
        width: 80%;
         
       
        text-align: center;

      }


      .th_deg
      {
        background-color: skyblue;


      }


      .img_size
      {
        width: 100px;
        height: 50px;
      }

.center{
  position: relative;
   
  left: 50%;
  transform: translate(-50%, -50%);
}

    </style>

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->


        <div class="main-panel">
          <div class="content-wrapper">

            <h1 class="title_deg">All Orders</h1>


            <div class="center">
              
              <form action="{{url('search')}}" method="get">

                @csrf
                
                <input type="text" style="color: black; width: 70%;" name="search" placeholder="Search For Something">


                <input type="submit" value="Search" class="btn btn-outline-primary">

              </form>


            </div>

            <div  style="overflow-x:auto;">
            <table class="table_deg">
              

              <tr class="th_deg">

                <th style="padding: 10px;">Name</th>
                <th style="padding: 10px;">Email</th>
                <th style="padding: 10px;">Address</th>
                <th style="padding: 10px;">Phone</th>
                <th style="padding: 10px;">Product title</th>
                <th style="padding: 10px;">Quantity</th>
                <th style="padding: 10px;">Price</th>
                <th style="padding: 10px;">Payment Status</th>
                <th style="padding: 10px;">Delivery Status</th>
                <th style="padding: 10px;">Image</th>
                <th style="padding: 10px;">Delivered</th>
                <th style="padding: 10px;">Print PDF</th>
                 <th style="padding: 10px;">Send Email</th>
                 
                
                
              </tr>


                @forelse($order as $order)

              <tr>
                
                <td>{{$order->name}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->product_title}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->payment_status}}</td>
                <td>{{$order->delivery_status}}</td>
               
                <td>
     
                  <img class="img_size" src="{{asset('product/'.$order->image)}}">


                </td>

                <td>

             @if($order->delivery_status=='processing')

                  
              <a href="{{url('delivered',$order->id)}}" onclick="confirmation(event)" class="btn btn-primary">Delivered</a>

              @else

              <p style="color: green;">Delivered</p>




              @endif

                </td>


                <td>
                  
                  <a target="_blank" href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">Print PDF</a>
 
                </td>
 

                <td>

                  <a href="{{url('send_email',$order->id)}}" class="btn btn-info">Send Email</a>
                  

                </td>


                

              </tr>


              @empty

              <tr>
                
                <td colspan="16">
                  No Data Found
                </td>

              </tr>


              @endforelse

            </table>

        </div>

          </div>

      @include('admin.footer')
        </div>
      
    <!-- container-scroller -->
    <!-- plugins:js -->

   
  <script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Are you sure this product is delivered",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {


                 
                window.location.href = urlToRedirect;
               
            }  
        });
    }
</script>

  
  <style>
    .swal-button--confirm {
      background-color: #DD6B55;
    }
  </style>


    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
