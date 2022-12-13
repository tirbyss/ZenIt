<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ImageUploadingTrait;
use App\Models\DataResi;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SellerOrderController extends Controller
{

    use ImageUploadingTrait;

    public function showUp(){

        $products = auth()->user()->products;

        $itemOrder = [];
        $individualOrder = [];
        $Paid = [];

        foreach($products as $product){
            $orderItem = $product->orderItem->all();
            array_push($itemOrder, $orderItem);
        }

        foreach($itemOrder as $inOrder){
            foreach($inOrder as $idnItem){
                array_push($individualOrder, $idnItem);
            }
        }

        foreach($individualOrder as $item){
            if($item->status == 'NOT CONFIRM'){
                if($item->orders->status == 'PAID'){
                    array_push($Paid, $item);
                }
            }  
        }

        return view('seller.upcoming', compact('Paid'));
    }

    public function accept($id){
        $order = OrderItem::find($id);
        
        $order->status = 'CONFIRMED';
        
        $order->update();
        
        $orders = $order->orders->orderItem->pluck('status')->all();

        if (!in_array('NOT CONFIRM', $orders)) {
            $data = $order->orders;

            $data->update([
                'status' => 'PROCESSED'
            ]);
        }
        return redirect()->back()->with([
            'massage' => 'The Order has been Confirmed'
        ]);
        
        
                // $check = $order->orders->orderItem;
        
                // $statusOne = [];
        
                // foreach($check as $item){
                //     array_push($statusOne, $item->status);
                // };
        
                // if(in_array("CANCELED", $statusOne)){
                //     foreach($check as $ite){
                //         $ite->status = 'CANCELED';
                //         $ite->update();
                //     }
                    
                //     return redirect()->back()->with([
                //         'massage' => 'The Order has been Canceled Because It Was Canceled by you, the customer or another Seller'
                //     ]);
                // }
    }
    
    public function reject($id){
        $order = OrderItem::find($id);

        $order->status = 'CANCELED';

        $order->update();

        return redirect()->back()->with([
            'massage' => 'The Order has been REJECTED'
        ]);

        // $check = $order->orders->orderItem;

        // $statusOne = [];

        // foreach($check as $item){
        //     array_push($statusOne, $item->status);
        // };

        // if(in_array("CANCELED", $statusOne)){
        //     foreach($check as $ite){
        //         $ite->status = 'CANCELED';
        //         $ite->update();
        //     }
            
        //     return redirect()->back()->with([
        //         'massage' => 'The Order has been Canceled Because It Was Canceled by you, the customer or another Seller'
        //     ]);
        // }
    }

    public function showPro(){
        $products = auth()->user()->products;

        $itemOrder = [];
        $individualOrder = [];
        $confirmed = [];

        foreach($products as $product){
            $orderItem = $product->orderItem->all();
            array_push($itemOrder, $orderItem);
        }

        foreach($itemOrder as $inOrder){
            foreach($inOrder as $idnItem){
                array_push($individualOrder, $idnItem);
            }
        }

        foreach($individualOrder as $item){
            if($item->status == 'CONFIRMED'){
                if($item->orders->status == 'PAID' || 'PROCESSED'){
                    array_push($confirmed, $item);
                }
            }  
        }

        return view('seller.processed', compact('confirmed'));
    }

    public function upResi(Request $request, $id){
        $order_items = OrderItem::find($id);

        
        $DataResi = DataResi::create([
            'orders_id' => $order_items->orders->id,
            'no_resi'=> $request->no_resi,
            'order_items_id' => $order_items->id,
            'created_at'=>Carbon::now()
        ]);
        
        foreach ($request->input('gallery', []) as $file) {
            $DataResi->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('gallery');
        }

        $order_items->update([
            'status'=>'SHIPPED',
        ]);

        return redirect()->back();
        
    }
}