<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    //
    public function index()
    {
        // get total count for category, product and order 
        $category = Category::all()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();


        // get sum of total sales
        $sales= DB::select(DB::raw('select sum(total_price) as total_price from orders'));
        $data1 = "";
        foreach ($sales as $val) {
            $data1.="$val->total_price";
        }
        $amt_sales = $data1;


        // get piechart for producy by category
        $result= DB::select(DB::raw('select c.name as category_name, count(p.id) counter from categories c left join products p on p.cate_id = c.id group by c.id, c.name'));
       
        $data2 = "";
        foreach ($result as $val) {
            $data2.="['".$val->category_name."', ".$val->counter."],";
        }
        $chartData = $data2;


        // get linechart for total sales by month
        $salesByMonth = DB::select(DB::raw('select DATE_FORMAT(created_at, "%Y-%m") AS day_date, SUM(orders.total_price) AS main_total, COUNT(*) 
        AS total_orders FROM orders WHERE orders.created_at >= "2021-08-31 00:00:00" AND orders.created_at <= "2022-11-31 23:59:59" 
        GROUP BY DATE_FORMAT(created_at, "%Y-%m") ORDER BY day_date ASC'));

        $data3 = "";
        foreach ($salesByMonth as $val) {
            $data3.="['".$val->day_date."', ".$val->main_total."],";
        }
        $chartSales = $data3;

        // get top 3 best selling product
        $topProduct = DB::select(DB::raw('select sum(o.qty) as total_sell, p.name as 
        product_name from order_items as o, products as p where o.prod_id=p.id group by p.name order by sum(o.qty) DESC limit 3'));

        $data4 = "";
        foreach ($topProduct as $val) {
            $data4.="['".$val->product_name."', ".$val->total_sell."],";
        }
        $chartProduct = $data4;

        // get top 5 order by state
        $topState = DB::select(DB::raw('select state as state_name, count(state) as no_order from orders group by state order by count(state) DESC limit 5'));

        $data5 = "";
        foreach ($topState as $val) {
            $data5.="['".$val->state_name."', ".$val->no_order."],";
        }
        $chartState = $data5;



        return view('admin.index', compact('category', 'product', 'chartData', 'order', 'amt_sales', 'chartSales', 'chartProduct', 'chartState'));
    }

  
}
