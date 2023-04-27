<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    @include('admin.css')

    <style type="text/css">
      
    

      .font_size
      {
        text-align: center;
        font-size: 40px;
        padding-top: 20px;
      }

      

      .th_color
      {
        background: skyblue;
      }


      
      table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
 
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





            <h2 class="font_size">All Messages</h2>

            <div style="overflow: auto;">
            <table class="center">
              
              <tr class="th_color">
                <th class="th_deg">Name</th>
                <th class="th_deg">Email</th>
                <th class="th_deg">Subject</th>
                <th class="th_deg">Message</th>
                
              </tr>

              @foreach($message as $message)

              <tr>
                <td>{{$message->name}}</td>
                <td>{{$message->email}}</td>
                <td>{{$message->subject}}</td>
                <td>{{$message->message}}</td>
                 
               

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
  </body>
</html>
