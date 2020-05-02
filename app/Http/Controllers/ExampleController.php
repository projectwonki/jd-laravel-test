<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use PDF;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function calculateDifferentiate()
    {
        $employee = DB::table('employees')->get();

        $employee_update = DB::table('employees_update')->get();

        $employee_avg = DB::table('employees')->avg('salary');

        $employee_update_avg = DB::table('employees_update')->avg('salary');

        $differentiation_result = $employee_avg - $employee_update_avg;

        return view('employees',compact('employee_avg','employee_update_avg','employee','employee_update','differentiation_result'),['meta_title' => 'Calculate Differentiation']);
    }

    public function stringReduce()
    {
        return view('string_reduce', ['meta_title' => 'String Reduce']);
    }

    public function getTcpdf()
    {
        return view('tcpdf',['meta_title' => 'TCPDF']);
    }

    public function postTcpdf(Request $request)
    {
        $image1 = $request->file('image1');
        // dd($image1->getRealPath());
        // dd($request->file('image1'), $request->file('image2')
        

    }

    public function getProduct()
    {
        $product = DB::table('product')->get();

        $discount = DB::table('discount')->get();

        return view('product',compact('product','discount'), ['meta_title' => 'Product Page']);
    }

    public function addToCart(Request $request)
    {
        $data['status'] = 'failed';
        $discount_percentage = 1;
        $discount = 0;

        if ($request->all()) {
            if ($request->dscode !== ''){
                $check_dscode = DB::table('discount')->where('discount_code',$request->dscode)->first();
                // dd($check_dscode, $request->dscode);
                if (is_null($check_dscode)) {
                    $data['status'] = 'Discount code is not valid!';    
                    return response()->json($data);
                } else {
                    $discount = (int) $check_dscode->discount_percentage;
                    $discount_percentage = $check_dscode->discount_percentage / 100;
                }
            }

            $before_discount = (int) $request->qty * $request->price;
            $after_discount = $before_discount * $discount_percentage;

            $check_existing_product = DB::table('cart')->where('product_id',$request->id)->first();

            if(!is_null($check_existing_product)) {
                DB::table('cart')->where('product_id', $request->id)->delete();
            }

            DB::table('cart')->insert([
                'product_id' => $request->id,
                'qty' => $request->qty,
                'price' => ($discount === 0) ? $request->price * $request->qty : $before_discount - $after_discount,
                'discount' => $discount,
            ]);

            $data['status'] = 'success add to cart!';
        }
        return response()->json($data);
    }

    public function deleteCart(Request $request)
    {
        $data['status'] = 'failed';

        if ($request->all()) {
            if ($request->id !== '') {
                DB::table('cart')->where('id', $request->id)->delete();
                $data['status'] = 'success';
                return response()->json($data);
            }
        }

        return response()->json($data);
    }

    public function getCart()
    {
        $cart = DB::table('cart')
                ->select('cart.id',
                'cart.product_id',
                'cart.qty',
                'cart.price',
                'cart.discount',
                'product.name',
                'product.image')
                ->join('product','cart.product_id','=','product.id')
                ->get();

        $sum_of_qty_cart = DB::table('cart')->sum('qty');
        $sum_of_cart_price = DB::table('cart')->sum('price');

        return view('cart', compact('cart','sum_of_cart_price','sum_of_qty_cart'), ['meta_title' => 'Cart Page']);
    }

    public function testingTcpdf()
    {
        $file1 = 'right-bottom.svg';
        $file2 = 'center.png';
        
        for ($i = 1; $i < 3; $i++) {
            PDF::SetTitle('Page'.$i);
            PDF::AddPage();
            PDF::setPage($i);
            if ($i === 1) {
                PDF::ImageSVG($file1, $x=90, $y=200, $w = 0, $h = 0, $link = '', $align = '', $palign = '', $border = 0, $fitonpage = false );
            } else {
                PDF::SetXY(50, 100);
                PDF::Image($file2, 90, 120, 40, '', 'PNG', '', 'T', false, 300, 'C', false, false, 0, false, false, false);
            }
            
            
        }

        PDF::Output(storage_path('tcpdf' . $this->generateRandomString() . '.pdf'), 'F');
        PDF::reset();

        return redirect('tcpdf-success');
    }

    public function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
