<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://payway.ababank.com/checkout-popup.html?file=css"/>
</head>
<body>
    <form action="https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/transaction-list" method="post">
        @foreach ($data as $key => $item )
            <input name="{{$key}}" value="{{$item}}" />
        @endforeach
        <br />
        <button type="submit">Submit</button>
    </form>
</body>
</html>