<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use Illuminate\Support\Str;
use App\Mail\CustomerRegisterMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function loginForm()
    {
        if (auth()->guard('customer')->check()) return redirect(route('customer.dashboard'));
        return view('ecommerce.login');
    }
    public function registerForm()
    {
        return view('ecommerce.register');
    }

    public function dashboard()
    {
        $orders = Order::selectRaw('COALESCE(sum(CASE WHEN status = 0 THEN subtotal END), 0) as pending, 
        COALESCE(count(CASE WHEN status = 3 THEN subtotal END), 0) as shipping,
        COALESCE(count(CASE WHEN status = 4 THEN subtotal END), 0) as completeOrder')
            ->where('customer_id', auth()->guard('customer')->user()->id)->get();

        return view('ecommerce.dashboard', compact('orders'));
    }

    public function login(Request $request)
    {
        //VALIDASI DATA YANG DITERIMA
        $this->validate($request, [
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|string'
        ]);

        //CUKUP MENGAMBIL EMAIL DAN PASSWORD SAJA DARI REQUEST
        //KARENA JUGA DISERTAKAN TOKEN
        $auth = $request->only('email', 'password');
        $auth['status'] = 1; //TAMBAHKAN JUGA STATUS YANG BISA LOGIN HARUS 1

        //CHECK UNTUK PROSES OTENTIKASI
        //DARI GUARD CUSTOMER, KITA ATTEMPT PROSESNYA DARI DATA $AUTH
        if (auth()->guard('customer')->attempt($auth)) {
            //JIKA BERHASIL MAKA AKAN DIREDIRECT KE DASHBOARD
            return redirect()->intended(route('customer.dashboard'));
        }
        //JIKA GAGAL MAKA REDIRECT KEMBALI BERSERTA NOTIFIKASI
        return redirect()->back()->with(['error' => 'Email / Password Salah']);
    }

    public function register(Request $request)
    {

        //VALIDASI DATANYA
        $this->validate($request, [
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required',
            'customer_address' => 'required|string'
        ]);
        
        $verify = Customer::where('email', $request->all()['email'])->exists();

        if ($verify) {
            return back()->with('error', 'This email exist');
        } else{
            //SIMPAN DATA CUSTOMER BARU
            $password = Str::random(8);
            $customer = Customer::create([
                'name' => $request->customer_name,
                'email' => $request->email,
                'password' => $password,
                'phone_number' => $request->customer_phone,
                'address' => $request->customer_address,
                'activate_token' => Str::random(30),
                'status' => false
            ]);

            Mail::to($request->email)->send(new CustomerRegisterMail($customer, $password));
            return redirect()->back()->with(['success' => 'Silahkan Cek Email untuk verivikasi dan mendapatkan password']);
        }
        
        
    }

    public function logout()
    {
        auth()->guard('customer')->logout(); //JADI KITA LOGOUT SESSION DARI GUARD CUSTOMER
        return redirect(route('customer.login'));
    }
}