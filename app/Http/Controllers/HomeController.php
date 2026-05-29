<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use Session;

use Stripe;

use App\Models\Comment;

use App\Models\Reply;

use App\Models\Contact;

use RealRashid\SweetAlert\Facades\Alert;



class HomeController extends Controller
{   
  

    public function index()
    {

        if(Auth::id())
        {


            $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
            $total_product=Product::all()->count();

            $total_order=Order::all()->count();

            $total_user=User::all()->count();

            $orders=Order::all();

            $total_revenue=0;

            foreach($orders as $order)

            {

                $total_revenue=$total_revenue + $order->price;


            }


       $total_delivered=Order::where('delivery_status','=','delivered')->get()->count();


       $total_processing=Order::where('delivery_status','=','processing')->get()->count();



            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        }


             elseif($usertype=='0')

             {
                $product=Product::orderby('id','desc')->paginate(6);

                $comment=Comment::orderby('id','desc')->get();



                $reply=Reply::all();

                $user_id=Auth::user()->id;

                $cart_count=Cart::where('user_id','=',$user_id)->count();

                
               
            return view('home.userpage',compact('product','comment','reply','cart_count'));

            }


        }

        else

        {

        $product=Product::orderby('id','desc')->paginate(6);

        
      $comment=Comment::orderby('id','desc')->get();

        $reply=Reply::all();



        return view('home.userpage',compact('product','comment','reply'));


        }

    }


    public function redirect()
    {

    	$usertype=Auth::user()->usertype;

    	if($usertype=='1')
    	{
            $total_product=Product::all()->count();

            $total_order=Order::all()->count();

            $total_user=User::all()->count();

            $orders=Order::all();

            $total_revenue=0;

            foreach($orders as $order)

            {

                $total_revenue=$total_revenue + $order->price;


            }


       $total_delivered=Order::where('delivery_status','=','delivered')->get()->count();


       $total_processing=Order::where('delivery_status','=','processing')->get()->count();



    		return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
    	}

    	else
    	{
    		$product=Product::orderby('id','desc')->paginate(6);

            $comment=Comment::orderby('id','desc')->get();



            $reply=Reply::all();

            $user_id=Auth::user()->id;

            $cart_count=Cart::where('user_id','=',$user_id)->count();

            
           
        return view('home.userpage',compact('product','comment','reply','cart_count'));
    	}
    }


    public function product_details($id)
    {
        $product=Product::with(['model', 'phoneCharacteristics.characteristic'])->findOrFail($id);

        if(Auth::id())
        {
            $user_id=Auth::user()->id;
            $cart_count=Cart::where('user_id','=',$user_id)->count();
            return view('home.product_details',compact('product','cart_count')); 
        }
        else
        {
            return view('home.product_details',compact('product'));
        }
    }


    public function add_cart(Request $request,$id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $user=Auth::user();
        $userid=$user->id;

        $product=Product::with('model')->findOrFail($id);

        $product_exist_id=Cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

        if($product_exist_id)
        {
            $cart=Cart::find($product_exist_id)->first();
            $quantity=$cart->quantity;
            $cart->quantity=$quantity + $request->quantity;
            $cart->price=$product->price * $cart->quantity;
            $cart->save();

            Alert::success('Product Added to Cart', 'You\'ve Successfully Added Product to the cart');
            return redirect()->back(); 
        }
        else
        {
            $cart=new Cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;
            $cart->product_title=$product->model->brand->brand_name .' '.$product->model->model_name;
            $cart->price=$product->price * $request->quantity;
            $cart->image=$product->image;
            $cart->product_id=$product->id;
            $cart->quantity=$request->quantity;
            $cart->save();

            Alert::success('Product Added to Cart', 'You\'ve Successfully Added Product to the cart');
            return redirect()->back();
        }
    }


    public function show_cart()
    {
        $id=Auth::user()->id;
        $cart_count=Cart::where('user_id','=',$id)->count();
        $cart = Cart::with('product')->where('user_id', '=', $id)->whereHas('product')->get();

        return view('home.showcart',compact('cart','cart_count'));
    }


    public function remove_cart($id)
    {
        $cart=Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cart->delete();

        return redirect()->back();
    }


    public function cash_order(Request $request)
    {
        $user=Auth::user();
        $userid=$user->id;

        $data=Cart::where('user_id','=',$userid)->get();

        if($data->isEmpty())
        {
            Alert::warning('No Product In Cart', 'Please Add some Product To the Cart');
            return redirect()->back();
        }

        foreach($data as $cartItem)
        {
            $order=new Order;
            $order->name=$cartItem->name;
            $order->email=$cartItem->email;
            $order->phone=$cartItem->phone;
            $order->address=$cartItem->address;
            $order->user_id=$cartItem->user_id;
            $order->product_title=$cartItem->product_title;
            $order->price=$cartItem->price;
            $order->quantity=$cartItem->quantity;
            $order->image=$cartItem->image;
            $order->product_id=$cartItem->product_id;
            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';
            $order->save();

            $cartItem->delete();
        }

        Alert::success('Thank You For your Order', 'We have Received your Order. We will connect with you soon...');
        return redirect()->back();
    }


    public function stripe($totalprice)
    {
        $userid=Auth::user()->id;
        $cart_count=Cart::where('user_id','=',$userid)->count();

        if($cart_count == 0)
        {
            Alert::warning('No Product In Cart', 'Please Add some Product To the Cart');
            return redirect()->back();
        }

        // Calculate price server-side to prevent manipulation
        $cartItems = Cart::where('user_id','=',$userid)->get();
        $calculatedTotal = $cartItems->sum('price');

        return view('home.stripe',compact('calculatedTotal','cart_count'));
    }


    public function stripePost(Request $request,$totalprice)
    {
        $request->validate([
            'stripeToken' => 'required|string',
        ]);

        $user=Auth::user();
        $userid=$user->id;

        $data=Cart::where('user_id','=',$userid)->get();

        if($data->isEmpty())
        {
            Alert::warning('No Product In Cart', 'Please Add some Product To the Cart');
            return redirect()->back();
        }

        // Calculate price server-side to prevent URL price manipulation
        $calculatedTotal = $data->sum('price');

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $calculatedTotal * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment." 
        ]);

        foreach($data as $cartItem)
        {
            $order=new Order;
            $order->name=$cartItem->name;
            $order->email=$cartItem->email;
            $order->phone=$cartItem->phone;
            $order->address=$cartItem->address;
            $order->user_id=$cartItem->user_id;
            $order->product_title=$cartItem->product_title;
            $order->price=$cartItem->price;
            $order->quantity=$cartItem->quantity;
            $order->image=$cartItem->image;
            $order->product_id=$cartItem->product_id;
            $order->payment_status='Paid';
            $order->delivery_status='processing';
            $order->save();

            $cartItem->delete();
        }
      
        Alert::Success('Payment Successful', 'Thanks for the Order . We Will send you the Product Within 48 Hours.');
              
        return back();
    }




    public function show_order()
    {
        $user=Auth::user();
        $userid=$user->id;
        $cart_count=Cart::where('user_id','=',$userid)->count();
        $order=Order::where('user_id','=',$userid)->get();

        return view('home.order',compact('order','cart_count'));
    }

    public function cancel_order($id)
    {
        // IDOR protection: ensure the order belongs to the authenticated user
        $order=Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $order->delivery_status='You canceled the order';
        $order->save();

        Alert::warning('Order Canceled', 'You Have Canceled Your Order');

        return redirect()->back();
    }


    public function add_comment(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment=new Comment;
        $comment->name=Auth::user()->name;
        $comment->user_id=Auth::user()->id;
        $comment->comment=$request->comment;
        $comment->save();

        return redirect()->back();
    }


    public function add_reply(Request $request)
    {
        $request->validate([
            'commentId' => 'required|integer|exists:comments,id',
            'reply' => 'required|string|max:1000',
        ]);

        $reply=new Reply;
        $reply->name=Auth::user()->name;
        $reply->user_id=Auth::user()->id;
        $reply->comment_id=$request->commentId;
        $reply->reply=$request->reply;
        $reply->save();

        return redirect()->back();
    }

    public function contact()
    {   
        if(Auth::id())
        {
            $user_id=Auth::user()->id;
            $cart_count=Cart::where('user_id','=',$user_id)->count();
            return view('home.contact',compact('cart_count'));
        }
        else
        {
            return view('home.contact');
        }
    }


    public function add_contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $contact=new Contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->subject=$request->subject;
        $contact->message=$request->message;
        $contact->save();

        Alert::success('Message Received', 'We will review your message and contact with you soon');
        return redirect()->back();
    }
}
