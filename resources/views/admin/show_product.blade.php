<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('admin.css')

    <style type="text/css">
      
      .center
      {
        margin:auto;
        width: 50%;
        border: 2px solid white;
        text-align: center;
        margin-top: 40px;
      }

      .font_size
      {
        text-align: center;
        font-size: 40px;
        padding-top: 20px;
      }

      .img_size
      {
        width: 150px;
        height: 150px;
      }

      .th_color
      {
        background: skyblue;
      }

      .th_deg
      {
        padding: 30px;
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
              @if(session()->has('message'))
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                  {{session()->get('message')}}
              </div>
              @endif

              <h2 class="font_size white">All Products</h2>

              <div style="overflow: auto;">
                  <table class="center">
                      <tr class="th_color">
                          <th class="th_deg">Product title</th>
                          <th class="th_deg">Description</th>
                          <th class="th_deg">Quantity</th>
                          <th class="th_deg">Catagory</th>
                          <th class="th_deg">Price</th>
                          {{-- <th class="th_deg" style="min-width: 200px">Characteristics</th>
                          <th class="th_deg">Operator</th>
                          <th class="th_deg">IMEI</th> --}}
                          {{-- <th class="th_deg">Condition</th> --}}
                          <th class="th_deg">Product Image</th>
                          <th class="th_deg">Delete</th>
                          <th class="th_deg">Edit</th>
                      </tr>

                      @foreach($product as $product)
                      <tr>
                        <td>{{$product->model->brand->brand_name}} - {{$product->model->model_name}}</td>
                          <td>{{$product->description}}</td>
                          <td>{{$product->quantity}}</td>
                          <td>{{$product->catagory}}</td>
                          <td>{{$product->price}}</td>
                          {{-- <td>
                            <ul style="text-align: left;">
                              @foreach($product->phoneCharacteristics as $phoneCharacteristic)
                                  @if($phoneCharacteristic->characteristic)
                                      <li>{{$phoneCharacteristic->characteristic->name}}: 
                                        
                                          {{$phoneCharacteristic->characteristic_value}}
                                          @if($phoneCharacteristic->characteristic->name == "Ram" || $phoneCharacteristic->characteristic->name == "Storage")
                                              GB
                                          @elseif($phoneCharacteristic->characteristic->name == "Screen")
                                              "
                                          @elseif($phoneCharacteristic->characteristic->name == "Main camera" || $phoneCharacteristic->characteristic->name == "Selfie camera")
                                              MP

                                          @endif
  
                                      </li>
                                  @else
                                      <li>Característica no encontrada: {{$phoneCharacteristic->characteristic_value}}</li>
                                  @endif
                              @endforeach
                          </ul>
                        </td> --}}

                          {{-- <td>{{$product->operator->operator_name}}</td>
                          <td>{{$product->imei}}</td> --}}
                          {{-- <td>{{$product->condition}}</td> --}}
                          <td>
                            <img class="img_size" src="{{asset('product/'.$product->image)}}">
                        </td>

                <td>
                  <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_product',$product->id)}}">Detele</a>
                </td>

                <td>
                  <a class="btn btn-success" href="{{url('update_product',$product->id)}}">Edit</a>
                </td>

              </tr>

              @endforeach

            </table>
            </div>

        </div>
      @include('admin.footer')
      </div>


    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->

     <script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure to Delete this product",
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
  </body>
</html>
