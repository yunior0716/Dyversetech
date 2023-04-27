<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Catagory;

use App\Models\Product;

use App\Models\Order;

use App\Models\User;

use App\Models\Contact;

use Illuminate\Support\Facades\Auth;

use PDF;

use Notification;

use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class AdminController extends Controller
{
       public function order()
    {


        if (Auth::id()) {


            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $order = order::orderby('id', 'desc')->get();


                return view('admin.order', compact('order'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }


    public function delivered($id)
    {


        if (Auth::id()) {


            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {



                $order = order::find($id);

                $order->delivery_status = "delivered";

                $order->payment_status = 'Paid';


                $order->save();


                return redirect()->back();
            } else {
                return redirect('login');
            }
        } else {

            return redirect('login');
        }
    }

    public function print_pdf($id)
    {
        if (Auth::id()) {


            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $order = order::find($id);


                return view('admin.pdf', compact('order'));
            } else {

                return redirect('login');
            }
        } else {

            return redirect('login');
        }
    }


    public function send_email($id)
    {

        if (Auth::id()) {


            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $order = order::find($id);

                return view('admin.email_info', compact('order'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }


    public function send_user_email(Request $request, $id)
    {


        if (Auth::id()) {


            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $order = order::find($id);


                $details = [

                    'greeting' => $request->greeting,

                    'firstline' => $request->firstline,

                    'body' => $request->body,

                    'button' => $request->button,

                    'url' => $request->url,

                    'lastline' => $request->lastline,

                ];

                FacadesNotification::send($order, new SendEmailNotification($details));

                return redirect()->back()->with('message', "Email is send to the Customer Successfully");
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }



    public function searchdata(Request $request)


    {


        if (Auth::id()) {


            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $searchText = $request->search;

                $order = order::where('name', 'LIKE', "%$searchText%")->orWhere('phone', 'LIKE', "%$searchText%")->orWhere('product_title', 'LIKE', "%$searchText%")->orWhere('email', 'LIKE', "%$searchText%")->get();


                return view('admin.order', compact('order'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function message()
    {


        if (Auth::id()) {


            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $message = contact::orderby('id', 'desc')->get();

                return view('admin.message', compact('message'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function customer()
    {

        if (Auth::id()) {


            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $user = user::where('usertype', '=', '0')->get();

                return view('admin.user', compact('user'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }


    







}
