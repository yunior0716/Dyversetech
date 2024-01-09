<!DOCTYPE html>
<html>
   <head>
     @include('home.css')

   </head>
   <body>

    @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->
       @include('home.header')
         <!-- end header section -->

      <!-- product section -->
      @include('home.product_view')
      <!-- end product section -->


      <!-- Comment and reply system starts here -->

      @include('home.comment')


      <!-- Comment and reply system ends here -->


    
 
      <div class="cpy_">
         <p class="mx-auto">© 2023 All Rights Reserved</p>
      </div>


      <script type="text/javascript">
         
         function reply(caller)
         {  
            document.getElementById('commentId').value=$(caller).attr('data-Commentid');

            $('.replyDiv').insertAfter($(caller));

            $('.replyDiv').show();

         }


         function reply_close(caller)
         {



            $('.replyDiv').hide();

         }

 
      </script>


    {{-- <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script> --}}


<script type="text/javascript">
  
/*   $(function() {
  $(document).on('mouseup', function (e) {
    e.preventDefault();
  });
}); */


</script>
            <!-- jQery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>



     
       <!-- Glide Carousel Script -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>
     
       <!-- Animate On Scroll -->
       <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
     
       <!-- Custom JavaScript -->
       <script src="../js/products.js"></script>
       <script src="../js/index.js"></script>
       <script src="../js/slider.js"></script>



   </body>
</html>