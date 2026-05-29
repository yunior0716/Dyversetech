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
        $order = Order::orderby('id', 'desc')->get();
        return view('admin.order', compact('order'));
    }


    public function delivered($id)
    {
        $order = Order::findOrFail($id);
        $order->delivery_status = "delivered";
        $order->payment_status = 'Paid';
        $order->save();

        return redirect()->back();
    }

    public function print_pdf($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.pdf', compact('order'));
    }


    public function send_email($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.email_info', compact('order'));
    }


    public function send_user_email(Request $request, $id)
    {
        $request->validate([
            'greeting' => 'required|string|max:255',
            'firstline' => 'required|string|max:500',
            'body' => 'required|string|max:2000',
            'button' => 'required|string|max:100',
            'url' => 'required|url|max:500',
            'lastline' => 'required|string|max:500',
        ]);

        $order = Order::findOrFail($id);

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
    }



    public function searchdata(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $searchText = $request->search;

        $order = Order::where('name', 'LIKE', "%$searchText%")
            ->orWhere('phone', 'LIKE', "%$searchText%")
            ->orWhere('product_title', 'LIKE', "%$searchText%")
            ->orWhere('email', 'LIKE', "%$searchText%")
            ->get();

        return view('admin.order', compact('order'));
    }

    public function message()
    {
        $message = Contact::orderby('id', 'desc')->get();
        return view('admin.message', compact('message'));
    }

    public function customer()
    {
        $user = User::where('usertype', '=', '0')->get();
        return view('admin.user', compact('user'));
    }
}
