@php
    function numberFormater($number,$digit=5){
        $length = strlen($number);
        if ($length < $digit) {
            $prefix ="";
            for ($i = 0; $i <($digit - $length); $i++) {
               $prefix .="0";
            }
            return $prefix.$number;
        }
        return $number;
    }
    $due = $info->order_amount - $info->paid_amount;
    if ($due < 1) {
        $payment_status  ='PAID';
        $payment_color  = 'green';
    }else {
        $payment_status  ='DUE';
        $payment_color  ='red';
    }

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .d-flex {
            display: flex;
        }

        p {
            font-size: 13px;
            line-height: 16px;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .address p {
            font-size: 13px;
            line-height: 20px;
        }

        .address p b {
            font-size: 15px;
        }

        .border-1 {
            font-size: 12px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .pd-5 {
            padding: 2px 20px 2px 5px;
        }

        .pd-2 {
            padding: 2px 5px 2px;
        }

        .pd-3 {
            padding: 2px 30px 2px 10px;
        }

        .invoice-no {
            margin-top: -20px;
        }

        .invoice {
            position: relative;
        }

        .footer {
            position: absolute;
            bottom: 0;
        }
        .qr{
            position: absolute;
            top:0;
            right: 0;
            height: 100px;
            width: 100px;
        }
        .text-capitalize{
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <table>
            <tr>
                <td width="300">
                    <div class="logo">
                        <img src="{{ public_path('assets/images/logo.png') }}" width="200" height="50">
                    </div>
                </td>
                <td width="300">
                    <div class="address">
                        <p><b>Corporate Office:</b><br>House #61,Road #17,Block #C,Banani Dhaka-1212<br><b>Online
                                Communication Office:</b> <br>House #40,Road #4,Block #D,Mohmmadpur Dhaka-1207<br>Cell:
                            01303-523442 , 01737927247</p>
                    </div>
                </td>
            </tr>
        </table>
        <table class="invoice-no">
            <tr>
                <td width="375">
                    <h1>Invoice</h1>
                </td>
                <td width="200">
                    <table class="border-1">
                        <tr align="left">
                            <td class="border-1 pd-5">Submited:</td>

                            <td class="border-1 pd-5">{{ $info->updated_at ?$info->updated_at->format('d-M-Y') :  $info->created_at->format('d-M-Y') }}</td>
                        </tr>
                        <tr>
                            <td class="border-1 pd-5">Invoice Number:</td>
                            <td class="border-1 pd-5">{{numberFormater($info->id) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="240">
                    <p><b>Invoice For</b><br> {{$info->company_name}} <br>{{$info->address}}</p>
                </td>
                <td width="200">
                    <p><b>Contact</b><br>{{$info->customer_name}} <br>{{$info->phone_number}} </p>
                </td>
                <td>
                    <p style="font-weight: 400;background: {{$payment_color}}; padding:5px 35px; color:#fff; "> {{$payment_status}}</p>
                </td>
            </tr>
        </table>
        <table class="border-1" style="margin-top: 40px">
            <tr align="left" style="background: #9e9d9d;">
                <th class="border-1 pd-2" width="255">Description</th>
                <th class="border-1 pd-2" width="80">Qty/USD</th>
                <th class="border-1 pd-2" width="80">Unit Price</th>
                <th class="border-1 pd-2" width="80">Total Price</th>
            </tr>
            @foreach ($order_details as $order_detail)
            <tr>
                <td class="border-1 pd-2">{{$order_detail->product_name}}</td>
                <td class="border-1 pd-2">USD {{$order_detail->quantity}}</td>
                <td class="border-1 pd-2">BDT {{$order_detail->unit_price}}</td>
                <td class="border-1 pd-2">BDT {{$order_detail->amount}}</td>
            </tr>
            @endforeach

            {{-- calculation --}}
            <tr>
                <td colspan="2" style="border: 1px solid #ffff; border-right: 1px solid black;"> </td>
                <td class="border-1 pd-2">Total</td>
                <td class="border-1 pd-2">BDT {{$info->order_amount}}</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid #ffff; border-right: 1px solid black;"> </td>
                <td class="border-1 pd-2">Paid</td>
                <td class="border-1 pd-2">BDT {{$info->paid_amount}}</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid #ffff; border-right: 1px solid black;"> </td>
                <td class="border-1 pd-2">Due</td>
                <td class="border-1 pd-2">BDT {{$info->order_amount - $info->paid_amount}}</td>
            </tr>
        </table>
        <table class="border-1" style="margin-top:30px">
            <tr>
                <th class="border-1 pd-3">In Word:</th>
                <th class="border-1 pd-3 text-capitalize">{{Terbilang::make($info->paid_amount).' taka only'}}</th>
            </tr>
        </table>
        <div style="border: 1px solid black; width:270px;margin-top:40px;">
            <p style="margin: 15px 7px; font-size:13px">
                <b>Payment Method</b><br>
                <b>BKash Rocket Nagad Personal:</b> 01303523442<br>
                <b>Bkash Merchant:</b> 01946908434
            </p>
        </div>
        <div class="footer">
            <table>
                <tr style="font-size: 13px">
                    <td width="235">
                        <p>
                            <b>Prepared By</b><br>
                            {{$info->created_by}}<br>
                            {{$info->designnation}}
                        </p>
                    </td>
                    <td>
                        <p>
                            <b>Approved By</b><br>
                            Nur Islam<br>
                            Head Of Sales
                        </p>
                    </td>
                </tr>
            </table>
            <div class="qr">
                <img src="data:image/png;base64, {{ base64_encode(QrCode::size(100)->generate('https://nugortech.com/')) }} ">
            </div>
            <div style="width: 430px; height:15px ;background-color:#0BFEFE"></div>
            <div style="width: 570px; height:15px ;background-color:#3F76D5"></div>
            <div style="width: 710px; height:15px ;background-color:#FE6C01"></div>
        </div>

    </div>
</body>

</html>
