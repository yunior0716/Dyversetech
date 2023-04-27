<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    <base href="/public">

    @include('admin.css')


    <style type="text/css">
      
      label
      {
        display: inline-block;
        width: 150px;
        font-size: 15px;
        font-weight: bold;
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


            <h1 style="text-align: center; font-size: 25px;">Send Email to <span style="color:skyblue;">{{$order->email}}</span></h1>


            <form action="{{url('send_user_email',$order->id)}}" method="POST">

              @csrf

            <div style="padding-left: 20%; padding-top: 30px;">

              <label>Email Greeting :</label>


              <textarea style="color: black;" type="text" name="greeting" rows="4" cols="25" required=""></textarea>

            </div>


             <div style="padding-left: 20%; padding-top: 30px;">

              <label>Email FirstLine :</label>

            

              <textarea style="color: black;" type="text" name="firstline" rows="4" cols="25" required=""></textarea>

            </div>


            <div style="padding-left: 20%; padding-top: 30px;">

              <label>Email Body :</label>

              

              <textarea style="color: black;" type="text" name="body" rows="4" cols="25" required=""></textarea>

            </div>



            <div style="padding-left: 20%; padding-top: 30px;">

              <label>Email Button name:</label>

              <input style="color: black;" type="text" name="button" placeholder="Optional">

            </div>


            <div style="padding-left: 20%; padding-top: 30px;">

              <label>Enter a Url Link:</label>

              <input style="color: black;" type="text" name="url" placeholder="Optional">

            </div>


            <div style="padding-left: 20%; padding-top: 30px;">

              <label>Email Last Line :</label>

           

               <textarea style="color: black;" type="text" name="lastline" rows="4" cols="25" required=""></textarea>

            </div>


            <div style="padding-left: 20%; padding-top: 30px;">

              

              <input type="submit" value="Send Email" class="btn btn-primary">

            </div>





            </form>



          </div>
@include('admin.footer')
        </div>


       
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
