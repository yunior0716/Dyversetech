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
         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div> 
     
      
      <!-- product section -->
      @include('home.product')
      <!-- end product section -->



       <!-- why section -->
      @include('home.why')
      <!-- end why section -->
      
       
       
      <!-- Comment and reply system starts here -->

      @include('home.comment')


      <!-- Comment and reply system ends here -->

<br><br>


      <!-- subscribe section -->
      @include('home.subscribe')
      <!-- end subscribe section -->
 
      <!-- client section -->
      @include('home.client')
      <!-- end client section -->

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      


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


    <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
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
       <script src="./js/products.js"></script>
       <script src="./js/index.js"></script>
       <script src="./js/slider.js"></script>




   </body>
</html>