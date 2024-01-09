<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    @include('admin.css')

    <style type="text/css">
      

      .div_center
      {
        text-align: center;
        padding-top: 40px;
      }

      .font_size
      {
        font-size: 40px;
        padding-bottom: 40px;
      }

      .text_color
      {
        color: black;
        padding-bottom: 20px;
      }

      label
      {
        display: inline-block;
        width: 200px;
      }

      .div_design
      {
        padding-bottom: 15px;
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

            

              <h1 class="font_size ">Update Product</h1>


              <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">

              @csrf

              <div class="div_design">
                <label>Product Model :</label>
    
                <select class="text_color" name="model_id" required="">
                  <option value="" selected="">{{$product->model->brand->brand_name}} - {{$product->model->model_name}}</option>
                  @foreach($models as $model)
                      <option value="{{$model->model_id}}">{{$model->brand->brand_name}} - {{$model->model_name}}</option>
                  @endforeach
              </select>
            </div>

            <div class="div_design">
              <label>Operator :</label>
              <select class="text_color" name="operator_id" required="">
                  <option value="" selected="">Select an operator</option>
                  @foreach($operators as $operator)
                      <option value="{{$operator->operator_id}}" @if($operator->operator_id == $product->operator_id) selected @endif>{{$operator->operator_name}}</option>
                  @endforeach
              </select>
          </div>
          <div>
              <p>Current operator: {{$product->operator->operator_name}}</p>
          </div>



            <div class="div_design">

              <label>Product Description :</label>
              <input class="text_color" type="text" name="description" placeholder="Write a description"  required="" value="{{$product->description}}">
              
            </div>

            <div class="div_design">

              <label>Product Price :</label>
              <input class="text_color" type="number" name="price" placeholder="Write a price" required="" value="{{$product->price}}">
              
            </div>

            <div class="div_design">

              <label>Discount Price :</label>
              <input class="text_color" type="number" name="dis_price" placeholder="Write a Discount is apply" value="{{$product->discount_price}}">
              
            </div>


            <div class="div_design">

              <label>Product Quantity :</label>
              <input class="text_color" type="number" min="0" name="quantity" placeholder="Write a quantity"  required="" value="{{$product->quantity}}">
              
            </div>
            
            <div class="div_design">
              <label>Product Catagory :</label>
              <select class="text_color" name="catagory"  required="">
                <option value="{{$product->catagory}}" selected="">{{$product->catagory}}</option>
                @foreach($catagory as $catagory)
                <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                @endforeach
              </select>
            </div>


            <div class="div_design">

              <label>IMEI :</label>
              <input class="text_color" type="text" name="imei" placeholder="Write the IMEI"  required="" value="{{$product->imei}}">
              
            </div>


            <div class="div_design">

              <label>Product Condition :</label>

              <select class="text_color" name="condition"  required="">

                <option value="" selected="">{{$product->condition}}</option>
                <option value="nuevo">New</option>
                <option value="nuevo">Used</option>
                <option value="usado">Refurbished</option>              

              </select>
              
            </div>




            @foreach($characteristics as $characteristic)
            <div class="div_design">
                <label for="characteristics[{{ $characteristic->characteristics_id }}]">{{ $characteristic->name }}</label>
                @php
                    $characteristicValue = $product->phoneCharacteristics->firstWhere('characteristic_id', $characteristic->characteristics_id)->characteristic_value ?? '';
                @endphp
                <input type="text" name="characteristics[{{ $characteristic->characteristics_id }}]" id="characteristics[{{ $characteristic->characteristics_id }}]" value="{{ $characteristicValue }}" required>
            </div>
          @endforeach



          <div class="div_design">

            <label>Current Product Image :</label>
            
            <img style="margin:auto;" height="100" width="100" src="{{asset('product/'.$product->image)}}">
            
          </div>        



          <div class="div_design">

            <label>Change Product Image :</label>
            
            <input type="file" name="image" >
            
          </div>


           <div class="div_design">

            
            
            <input type="submit" value="Update Product" class="btn btn-primary">
            
          </div>


          </form>
              
              

            

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