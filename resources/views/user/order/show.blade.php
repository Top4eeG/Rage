@extends('user.layouts.master')

@section('title','Детали заказа')

@section('main-content')
<div class="card">
<h5 class="card-header">Заказ       <a href="{{route('order.pdf',$order->id)}}" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Сгенерировать PDF</a>
  </h5>
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>ID</th>
            <th>№ заказа</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Количество</th>
            <th>Доставка</th>
            <th>Итоговая стоимость</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->quantity}}</td>
            <td>BYN {{$order->shipping->price}}</td>
            <td>BYN {{number_format($order->total_amount,2)}}</td>
            <td>
                @if($order->status=='new')
                  <span class="badge badge-primary">{{$order->status}}</span>
                @elseif($order->status=='process')
                  <span class="badge badge-warning">{{$order->status}}</span>
                @elseif($order->status=='delivered')
                  <span class="badge badge-success">{{$order->status}}</span>
                @else
                  <span class="badge badge-danger">{{$order->status}}</span>
                @endif
            </td>
            <td>
                <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                  @csrf
                  @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Удалить"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>

        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">Oнформация о заказе</h4>
                <table class="table">
                    <tr class="">
                        <td>Номер заказа</td>
                        <td> : {{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <td>Дата/время заказа</td>
                        <td> : {{$order->created_at->setTimezone('Europe/Minsk')->locale('ru')->translatedFormat('H:i | d F Y')}} </td>
                    </tr>
                    <tr>
                        <td>Количество</td>
                        <td> : {{$order->quantity}}</td>
                    </tr>
                    <tr>
                        <td>Статус заказа</td>
                        <td> : {{$order->status}}</td>
                    </tr>
                    <tr>
                        <td>Доставка</td>
                        <td> : BYN {{$order->shipping->price}}</td>
                    </tr>
                    <tr>
                        <td>Купон</td>
                        <td> : BYN {{number_format($order->coupon,2)}}</td>
                    </tr>
                    <tr>
                        <td>Итоговая стоимость</td>
                        <td> : BYN {{number_format($order->total_amount,2)}}</td>
                    </tr>
                    <tr>
                        <td>Способ оплаты</td>
                        <td> : @if($order->payment_method=='cod') Наличными при получении @else Paypal @endif</td>
                    </tr>
                    <tr>
                        <td>Статус оплаты</td>
                        <td> : {{$order->payment_status}}</td>
                    </tr>
                </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">Информация о доставке</h4>
                <table class="table">
                    <tr class="">
                        <td>Полное имя</td>
                        <td> : {{$order->first_name}} {{$order->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> : {{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>Номер телефона</td>
                        <td> : {{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>Адрес</td>
                        <td> : {{$order->address1}}, {{$order->address2}}</td>
                    </tr>
                    <tr>
                        <td>Город</td>
                        <td> : {{$order->country}}</td>
                    </tr>
                    <tr>
                        <td>Почтовый индекс</td>
                        <td> : {{$order->post_code}}</td>
                    </tr>
                </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif

  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush
