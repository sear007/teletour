<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{public_path().'/css/bootstrap.min.css'}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>RECEIPT</title>
</head>
<body>
<div class="container-fluid">
    <table class="table" style="border: 0;">
        <tbody>
        <tr>
            <td style="border-color: transparent; width: 70%">
                <img width="120" height="120" src="{{public_path().'/images/logo.png'}}" />
            </td>
            <td style="border-color: transparent; text-align: left">
                <h5 class="m-0 text-dark font-weight-bold">RECEIPT</h5>
                <p class="m-0 text-dark small">Date: {{$payment->modfied}}</p>
                <p class="m-0 text-dark small">Order ID: {{$payment->code}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-color: transparent; ">
                <p>Your order confirmed</p>
                <div style="background: #fff0c3; padding: 10px">
                    <div style="display: flex; justify-content:space-between">
                        <p style="flex: 1; margin-bottom: 0">Total</p>
                        <div style="text-align: right;">
                            <p><strong>{{price($payment->price)}}</strong></p>
                            <p><small>Paid by {{$payment->name}}</small></p>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>Quantity Room</th>
                    <th>Length of stay</th>
                    <th>Rate</th>
                    <th>Discount</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p class="mb-0 h6 font-weight-bold">{{$payment->branch ? $payment->branch->name : ''}}</p>
                        <p class="mb-0 text-muted font-weight-bold">{{$payment->roomType ? $payment->roomType->name : ''}}</p>
                    </td>
                    <td>{{$payment->num_rooms}}</td>
                    <td>{{displayQuantityDay($payment->qauntity)}}</td>
                    <td>{{$payment->roomType ? price($payment->roomType->price) : ''}}</td>
                    <td>0%</td>
                    <td>{{price($payment->price)}}</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="5">
                        <p class="m-0 text-dark">Sub Total</p>
                    </td>
                    <td>{{price($payment->price)}}</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="5">
                        <p class="m-0 text-dark">Total</p>
                    </td>
                    <td>{{price($payment->price)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div style="position: fixed; bottom: 0; left: 0; width: 100%; padding: 5px; text-align: right; background: #ccc; font-size: 11px;">
    <div><strong>www.bookteletour.com</strong></div>
</div>
</body>
</html>