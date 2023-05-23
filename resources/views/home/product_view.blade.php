<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
              


               <div>
                  <form action="{{url('search_product')}}" method="GET">
                     @csrf
                     <div class="form-group">
                         <label>Select filters</label>
                         <div class="btn-group-toggle" data-toggle="buttons">
                             @foreach($filters as $filter)
                                 <label class="btn btn-outline-primary" style="font-size: 15px">
                                     <input type="checkbox" name="filter_ids[]" value="{{$filter->filter_id}}" autocomplete="off"> {{$filter->filter_name}}
                                 </label>
                             @endforeach
                         </div>
                     </div>
                     <input class="search_box" type="text" name="search" placeholder="Search for Something">
                     <input type="submit" value="search">
                 </form>
              </div>

            
            <div class="row">

               @foreach($product as $products)

               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box product-card" style="text-align: center">

                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details',$products->id)}}" class="option1">
                           Product Details
                           </a>

                           <form action="{{url('add_cart',$products->id)}}" method="Post">

                              @csrf

                              <div class="row">

                                 <div style="margin: auto; padding-left: 14px; padding-top: 20px;" class="quantity">

                                    <input type="number" name="quantity" value="1" min="1" max="{{$products->quantity}}" step="1" autofocus="autofocus" style="width: 100px">



                                 </div>



                                 <div style="padding-left: 14px!important; margin: auto;">

                                    <input type="submit" style="background-color: rgb(216, 217, 218)!important" value="Add To Cart">

                                 </div>
                                 
                                 

                              </div>

                           </form>
                           

                        </div>
                     </div>

                    <div class="product__header">
                     <img src="product/{{$products->image}}" alt="">
                   </div>

                   <div class="product__footer">
                     <h3>{{$products->model->brand->brand_name}}  {{$products->model->model_name}}</h3>
                     <div class="rating">
                        <svg>
                          <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                        </svg>
                        <svg>
                          <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                        </svg>
                        <svg>
                          <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                        </svg>
                        <svg>
                          <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                        </svg>
                        <svg>
                          <use xlink:href="./images/sprite.svg#icon-star-empty"></use>
                        </svg>
                      </div>
                     <div class="product__price">
                       <h4>${{$products->price}}</h4>
                     </div> 

                     <h6>Available Quantity : {{$products->quantity}}</h6>
                  </div>
               </div>
            </div>

               @endforeach
 </div>



      </section> 
      <div style="margin:40px;">

         {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}

         </div>


      <script>
         function addSelectedFiltersToForm(form) {
             const filterSelect = document.getElementById('filter-select');
             const selectedFilterId = filterSelect.value;
     
             if (selectedFilterId) {
                 const hiddenInput = document.createElement('input');
                 hiddenInput.type = 'hidden';
                 hiddenInput.name = 'filter_id';
                 hiddenInput.value = selectedFilterId;
                 form.appendChild(hiddenInput);
             }
         }
     </script>

