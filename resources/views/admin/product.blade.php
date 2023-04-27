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

            

              <h1 class="font_size">Add Product</h1>


              <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">

              @csrf

              <div class="div_design">
                <label>Product Model :</label>
    
                <select class="text_color" name="model_id" required="">
                  <option value="" selected="">Select a model</option>
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
                      <option value="{{$operator->operator_id}}">{{$operator->operator_name}}</option>
                  @endforeach
              </select>
          </div>



            <div class="div_design">

              <label>Product Description :</label>
              <input class="text_color" type="text" name="description" placeholder="Write a description"  required="">
              
            </div>

            <div class="div_design">

              <label>Product Price :</label>
              <input class="text_color" type="number" name="price" placeholder="Write a price" required="">
              
            </div>

            <div class="div_design">

              <label>Discount Price :</label>
              <input class="text_color" type="number" name="dis_price" placeholder="Write a Discount is apply">
              
            </div>


            <div class="div_design">

              <label>Product Quantity :</label>
              <input class="text_color" type="number" min="0" name="quantity" placeholder="Write a quantity"  required="">
              
            </div>
            
            <div class="div_design">

              <label>Product Catagory :</label>

              <select class="text_color" name="catagory"  required="">

                <option value="" selected="">Add a catagory here</option>

                @foreach($catagory as $catagory)

                <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>

                @endforeach

              </select>
              
            </div>


            <div class="div_design">

              <label>IMEI :</label>
              <input class="text_color" type="text" name="imei" placeholder="Write the IMEI"  required="">
              
            </div>


            <div class="div_design">

              <label>Product Condition :</label>

              <select class="text_color" name="condition"  required="">

                <option value="" selected="">Select the product condition</option>
                <option value="nuevo">New</option>
                <option value="nuevo">Used</option>
                <option value="usado">Refurbished</option>              

              </select>
              
            </div>




            @foreach($characteristics as $characteristic)
            <div class="div_design">
                <label for="characteristics[{{ $characteristic->characteristics_id }}]">{{ $characteristic->name }}</label>
                <input type="text" name="characteristics[{{ $characteristic->characteristics_id }}]" id="characteristics[{{ $characteristic->characteristics_id }}]" required>
            </div>
            @endforeach
            
            





            <div class="div_design">

              <label>Product Image Here :</label>
              
              <input type="file" name="image"  required="">
              
            </div>


             <div class="div_design">

              
              
              <input type="submit" value="Add Product" class="btn btn-primary">
              
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
