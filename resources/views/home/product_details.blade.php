<!DOCTYPE html>
<html>
  <head>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @include('home.css')

</head>

<body>
  @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->
       @include('home.header')
         <!-- end header section -->

  <main id="main">
    <div class="container">
      <!-- Products Details -->
      <section class="section product-details__section">
        <div class="product-detail__container">
          <div class="product-detail__left">
            <div class="details__container--left">
              <div class="product__picture" id="product__picture">
                <!-- <div class="rect" id="rect"></div> -->
                <div class="picture__container">
                  <img src="{{asset('product/'.$product->image)}}" alt="">
                </div>
              </div>
              <div class="zoom" id="zoom"></div>
            </div>

            <div class="product-details__btn">
              <form action="{{url('add_cart',$product->id)}}" method="Post">

                @csrf

                <div class="row">

                   <div class="col-md-4">

                      <input type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}" style="width: 100px">

                   </div>

                   <div class="col-md-4">

                      <input type="submit" value="Add To Cart">

                   </div>
                   
                   

                </div>

             </form>
            </div>
            
          </div>

          <div class="product-detail__right">
            <div class="product-detail__content">
              <h3>{{$product->model->brand->brand_name}}  {{$product->model->model_name}}</h3>
              <div class="price">
                <span class="new__price">${{$product->price}}</span>
              </div>
              <div class="product__review">
                <div class="rating">
                  <svg>
                    <use xlink:href="../images/sprite.svg#icon-star-full"></use>
                  </svg>
                  <svg>
                    <use xlink:href="../images/sprite.svg#icon-star-full"></use>
                  </svg>
                  <svg>
                    <use xlink:href="../images/sprite.svg#icon-star-full"></use>
                  </svg>
                  <svg>
                    <use xlink:href="../images/sprite.svg#icon-star-full"></use>
                  </svg>
                  <svg>
                    <use xlink:href="../images/sprite.svg#icon-star-empty"></use>
                  </svg>
                </div>
              </div>
              <p>
                {{$product->description}}
              </p>
              <div class="product__info-container">
                <ul class="product__info">
                  

                <li>
                    <span>Operator:</span>
                    <a href="#">{{$product->operator->operator_name}}</a>
                  </li>

                  <li>
                    <span>Condition:</span>
                    <a href="#">{{$product->condition}}</a>
                  </li>

                  <li>
                            <ul>
                                @foreach($product->phoneCharacteristics as $phoneCharacteristic)
                                    @if($phoneCharacteristic->characteristic)
                                        <li>{{$phoneCharacteristic->characteristic->name}}: 
                                          <a href="#">
                                            {{$phoneCharacteristic->characteristic_value}}
                                            @if($phoneCharacteristic->characteristic->name == "Ram" || $phoneCharacteristic->characteristic->name == "Storage")
                                                GB
                                            @elseif($phoneCharacteristic->characteristic->name == "Screen")
                                                "
                                            @elseif($phoneCharacteristic->characteristic->name == "Main camera" || $phoneCharacteristic->characteristic->name == "Selfie camera")
                                                MP

                                            @endif
                                        </a>
                                        </li>
                                    @else
                                        <li>Característica no encontrada: {{$phoneCharacteristic->characteristic_value}}</li>
                                    @endif
                                @endforeach
                            </ul>
                  </li>



                  <li>
                    <span>Availability:</span>
                    <a href="#" class="in-stock">In Stock ({{$product->quantity}}) </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

    <!-- Facility Section -->
    <section class="facility__section section" id="facility">
      <div class="container">
        <div class="facility__contianer">
          <div class="facility__box">
            <div class="facility-img__container">
              <svg>
                <use xlink:href="../images/sprite.svg#icon-airplane"></use>
              </svg>
            </div>
            <p>FREE SHIPPING WORLD WIDE</p>
          </div>

          <div class="facility__box">
            <div class="facility-img__container">
              <svg>
                <use xlink:href="../images/sprite.svg#icon-credit-card-alt"></use>
              </svg>
            </div>
            <p>100% MONEY BACK GUARANTEE</p>
          </div>

          <div class="facility__box">
            <div class="facility-img__container">
              <svg>
                <use xlink:href="../images/sprite.svg#icon-credit-card"></use>
              </svg>
            </div>
            <p>MANY PAYMENT GATWAYS</p>
          </div>

          <div class="facility__box">
            <div class="facility-img__container">
              <svg>
                <use xlink:href="../images/sprite.svg#icon-headphones"></use>
              </svg>
            </div>
            <p>24/7 ONLINE SUPPORT</p>
          </div>
        </div>
      </div>
    </section>
    
  </main>

  
       <!-- footer start -->
       @include('home.footer')
       <!-- footer end -->
       
            <!-- jQery -->
       <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
       <!-- popper js -->
       <script src="{{asset('home/js/popper.min.js')}}"></script>
       <!-- bootstrap js -->
       <script src="{{asset('home/js/bootstrap.js')}}"></script>
       <!-- custom js -->
       <script src="{{asset('home/js/custom.js')}}"></script>

  <!-- End Footer -->

  <!-- Go To -->

  <a href="#header" class="goto-top scroll-link">
    <svg>
      <use xlink:href="../images/sprite.svg#icon-arrow-up"></use>
    </svg>
  </a>

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