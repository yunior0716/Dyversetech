<!DOCTYPE html>
<html>
<head>
	<title>Order PDF</title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
    </script>
</head>
<body>

	

		<div class="container">
        <button id="button" class="btn btn-danger">Generate PDF</button>
        <div class="card" id="makepdf">
        	<div style="text-align:center;">
	<h1>Order Details</h1>


	<h5>Customer Name :{{$order->name}}</h5>

	<h5>Customer email :{{$order->email}}</h5>

	<h5>Customer phone :{{$order->phone}}</h5>

	<h5>Customer address :{{$order->address}}</h5>

	<h5>Customer Id:{{$order->user_id}}</h5>


	<h5>Product Name:{{$order->product_title}}</h5>


	<h5>Product price:{{$order->price}}</h5>

	<h5>Product Quantity:{{$order->quantity}}</h5>

	<h5>Payment Status :{{$order->payment_status}}</h5>

	<h5>Product Id:{{$order->product_id}}</h5>

<br><br>
	 

	<img height="250" width="450" src="{{ asset('product/' . $order->image) }}" />

	
</div>

</div>

</div>

<script>
        var button = document.getElementById("button");
        var makepdf = document.getElementById("makepdf");
  
        button.addEventListener("click", function () {
            html2pdf().from(makepdf).save();
        });
    </script>
</body>
</html>