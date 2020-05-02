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

        if ($request->all()) {
            if ($request->dscode !== ''){
                $check_dscode = DB::table('discount')->where('discount_code', $request->dsode)->first();

                if (is_null($check_dscode)) {
                    $data['status'] = 'Discount code is not valid!';    
                    return response()->json($data);
                } else {
                    $discount_percentage = $check_dscode->discount_percentage / 100;
                }
            }

            $before_discount = (int) $request->qty * $request->price;
            $after_discount = $before_discount * $discount_percentage;

            DB::table('cart')->insert([
                'product_id' => $request->id,
                'qty' => $request->qty,
                'price' => $after_discount,
            ]);

            $data['status'] = 'success add to cart!';
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
                'product.name',
                'product.image')
                ->join('product','cart.product_id','=','product.id')
                ->get();

        return view('cart', compact('cart'), ['meta_title' => 'Cart Page']);
    }

    public function testingTcpdf()
    {
        $file1 = 'right-bottom.svg';
        $file2 = 'center.png';
        
        for ($i = 1; $i < 3; $i++) {
            PDF::SetTitle('Page'.$i);
            PDF::AddPage();
            PDF::setPage($i);
            // PDF::Write(0, 'Hello World'.$i);
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
