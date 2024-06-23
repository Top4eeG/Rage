@extends('backend.layouts.master')
@section('title','E-SHOP || All Notifications')
@section('main-content')
<div class="card">
    <div class="row">
        <div class="col-md-12">
           @include('backend.layouts.notification')
        </div>
    </div>
  <h5 class="card-header">Уведомления</h5>
  <div class="card-body">
    @if(count(Auth::user()->Notifications)>0)
    <table class="table  table-hover admin-table" id="notification-dataTable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Дата/Время</th>
          <th scope="col">Заголовок</th>
          <th scope="col">Действия</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( Auth::user()->Notifications as $notification)

        <tr class="@if($notification->unread()) bg-light border-left-light @else border-left-success @endif">
          <td scope="row">{{$loop->index +1}}</td>
          <td>{{$notification->created_at->setTimezone('Europe/Minsk')->locale('ru')->translatedFormat('H:i / d F Y')}}</td>
          <td>{{$notification->data['title']}}</td>
          <td>
            <a href="{{route('admin.notification', $notification->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
            <form method="POST" action="{{ route('notification.delete', $notification->id) }}">
              @csrf
              @method('delete')
                  <button class="btn btn-danger btn-sm dltBtn" data-id={{$notification->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
            </form>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
    @else
      <h2>Уведомлений нет!</h2>
    @endif
  </div>
</div>
@endsection
@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

@endpush
@push('scripts')
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#notification-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
  </script>
  <script>
    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $('.dltBtn').click(function(e){
          var form=$(this).closest('form');
            var dataID=$(this).data('id');
            // alert(dataID);
            e.preventDefault();
            swal({
                title: "Вы уверены?",
                text: "Удалив, вы не сможете восстановить данные!",
                icon: "warning",
                buttons: {
                    cancel: "Отмена", // Текст для кнопки отмены
                    confirm: {
                        text: "Удалить", // Текст для кнопки подтверждения
                        value: true,
                        visible: true,
                        className: "swal-button--danger",
                    },
                },
                dangerMode: true,
              })
              .then((willDelete) => {
                  if (willDelete) {
                    form.submit();
                  } else {
                      swal("Уведомление не было удалено!");
                  }
              });
        })
    })
  </script>
@endpush
