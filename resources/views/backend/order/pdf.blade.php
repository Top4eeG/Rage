<!DOCTYPE html>
<html>
<head>
    <title>Заказ @if($order)- {{$order->order_number}} @endif</title>
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}">
    <style type="text/css">
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        .invoice-header {
            background: #f7f7f7;
            padding: 10px 20px;
            border-bottom: 1px solid gray;
        }
        .site-logo {
            margin-top: 20px;
        }
        .invoice-right-top h3 {
            padding-right: 20px;
            margin-top: 20px;
            color: green;
            font-size: 30px!important;
            font-family: serif;
        }
        .invoice-left-top {
            border-left: 4px solid green;
            padding-left: 20px;
            padding-top: 20px;
        }
        .invoice-left-top p {
            margin: 0;
            line-height: 20px;
            font-size: 16px;
            margin-bottom: 3px;
        }
        thead {
            background: green;
            color: #FFF;
        }
        .authority h5 {
            margin-top: -10px;
            color: green;
        }
        .thanks h4 {
            color: green;
            font-size: 25px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
        .site-address p {
            line-height: 6px;
            font-weight: 300;
        }
        .table tfoot .empty {
            border: none;
        }
        .table-bordered {
            border: none;
        }
        .table-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0,0,0,.03);
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        .table td, .table th {
            padding: .30rem;
        }
    </style>
</head>
<body>

@if($order)
    <div class="invoice-header">
        <div class="float-left site-logo">
            <img src="{{ public_path('storage/photos/1/Изображения/logo.jpg') }}" alt="">
        </div>
        <div class="float-right site-address">
            <h4>{{ env('APP_NAME') }}</h4>
            <p>{{ env('APP_ADDRESS') }}</p>
            <p>Номер телефона: <a href="tel:{{ env('APP_PHONE') }}">{{ env('APP_PHONE') }}</a></p>
            <p>Email: <a href="mailto:{{ env('APP_EMAIL') }}">{{ env('APP_EMAIL') }}</a></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="invoice-description">
        <div class="invoice-left-top float-left">
            <h6>Выписка</h6>
            <h3>{{$order->first_name}} {{$order->last_name}}</h3>
            <div class="address">
                <p><strong>Город: </strong> {{$order->country}}</p>
                <p><strong>Адрес: </strong> {{ $order->address1 }} OR {{ $order->address2}}</p>
                <p><strong>Телефон:</strong> {{ $order->phone }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
            </div>
        </div>
        <div class="invoice-right-top float-right">
            <h3>Выписка #{{$order->order_number}}</h3>
            <p>{{ $order->created_at->setTimezone('Europe/Minsk')->locale('ru')->translatedFormat('H:i | d F Y') }}</p>
        </div>
        <div class="clearfix"></div>
    </div>
    <section class="order_details pt-3">
        <div class="table-header">
            <h5>Детали заказа</h5>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col" class="col-6">Изделие</th>
                <th scope="col" class="col-3">Количество</th>
                <th scope="col" class="col-3">Итого</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->cart_info as $cart)
                <tr>
                    <td><span>{{ $cart->product->title }}</span></td>
                    <td>x{{ $cart->quantity }}</td>
                    <td><span>BYN {{ number_format($cart->price, 2) }}</span></td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th scope="col" class="empty"></th>
                <th scope="col" class="text-right">Стоимость:</th>
                <th scope="col"><span>BYN {{ number_format($order->sub_total, 2) }}</span></th>
            </tr>
            <tr>
                <th scope="col" class="empty"></th>
                <th scope="col" class="text-right">Доставка:</th>
                <th><span>BYN {{ number_format($order->shipping->price, 2) }}</span></th>
            </tr>
            <tr>
                <th scope="col" class="empty"></th>
                <th scope="col" class="text-right">Итого:</th>
                <th><span>BYN {{ number_format($order->total_amount, 2) }}</span></th>
            </tr>
            </tfoot>
        </table>
    </section>
    <div class="thanks mt-3">
        <h4>Спасибо !!</h4>
    </div>
    <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Подпись:</h5>
    </div>
    <div class="clearfix"></div>
@else
    <h5 class="text-danger">Недействительный</h5>
@endif

</body>
</html>
