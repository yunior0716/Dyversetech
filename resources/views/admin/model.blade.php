<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('admin.css')

    <style type="text/css">
    	
    	.div_center
    	{
    		text-align: center;
    		padding-top: 40px;
    	}

    	.h2_font
    	{
    		font-size: 40px;
    		padding-bottom: 40px;
    	}

    	.input_color
    	{
    		color: black;
    	}

      .center
      {
        margin: auto;
        width: 50%;
        text-align: center;
        margin-top: 30px;
        border: 3px solid white;
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

            <div class="div_center">
              <h2 class="h2_font white">Add model</h2>
          
              <form action="{{url('/add_model')}}" method="POST">
                  @csrf
          
                  <div class="div_design">
                      <label class="white">Brand :</label>
          
                      <select class="text_color" name="brand_id" required="">
                          <option value="" selected="">Select a brand</option>
          
                          @foreach($brand as $brand)
                              <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                          @endforeach
                      </select>
                  </div>
          
                  <input class="input_color" type="text" name="model" placeholder="Write model name">
                  <input type="submit" class="btn btn-primary" name="submit" value="Add model">
              </form>
          </div>
               
          
          
            <div  style="overflow-x:auto;">
              
            <table class="center">
              
              <tr>
                <td>Brand Name</td>
                <td>Model Name</td>
                <td>Action</td>
              </tr>


              @foreach($data as $item)

              <tr>

                <td>{{$item->brand->brand_name}}</td>

                <td>{{$item->model_name}}</td>

                <td>

                  <a onclick="confirmation(event)" class="btn btn-danger" href="{{url('delete_model',$item->id)}}">Delete</a>

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

     <script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure to Delete this model",
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
    @include('admin.script')
    <!-- End custom js for this page -->


  </body>
</html>
