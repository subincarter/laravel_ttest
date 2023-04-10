<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index($id)
    {
        $product = Products::find($id);
        Orders::create([
            'product_id' => $id,
            'customer_id' => session('id'),
            'price' => $product->id,
        ]);

        return redirect()->route('products');
    }
    public function removeProduct($id)
    {
        Orders::where('id', $id)->delete();
        return redirect()->route('cartList');
    }
    public function buyProduct($id)
    {
        $customer =  Orders::with('customer')->where('id', $id)->get();
        $data = [
            'order_id' => $customer[0]->id,
            'customer_email' => $customer[0]->customer->email,
            'amount' => $customer[0]->price
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fakedata.nanocorp.io/api/payment/create", // your preferred url
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            print_r(json_decode($response));
            $finalResult = json_decode($response);
            if ($finalResult->result == 'success') {
                print_r($finalResult->data->payment_intend);
                $this->finishPayment($id,$finalResult->data->payment_intend);
                return true;
            }
        }
    }
    public function finishPayment($id,$payment_intend)
    {
        $payment_intend = 'yahcskacasicjsakcjsakncjasnkcnasjkcnksajcnkskcnajcs=';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https: //fakedata.nanocorp.io/api/payment/confirm", // your preferred url
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => ['payment_intend' => $payment_intend],
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response2 = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        print_r(json_decode($response2));

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $status = json_decode($response2);
            if ($status->result == "success") {
                Orders::where('id', $id)->update([
                    'payment' => 1
                ]);
                echo  'payment success';

                return redirect()->route('cartList');
            }else{
               return $status['data'];
            }
        }
    }
}
