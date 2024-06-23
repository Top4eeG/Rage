@extends('user.layouts.master')

@section('title','Редактирование отзыва')

@section('main-content')
<div class="card">
  <h5 class="card-header">Редактирование отзыва</h5>
  <div class="card-body">
    <form action="{{route('user.productreview.update',$review->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="name">От:</label>
        <input type="text" disabled class="form-control" value="{{$review->user_info->name}}">
      </div>
      <div class="form-group">
        <label for="review">Сообщение</label>
      <textarea name="review" id="" cols="20" rows="10" class="form-control">{{$review->review}}</textarea>
      </div>
      <div class="form-group">
        <label for="status">Статус :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Выберите статус--</option>
          <option value="active" {{(($review->status=='active')? 'selected' : '')}}>Активен</option>
          <option value="inactive" {{(($review->status=='inactive')? 'selected' : '')}}>Неактивен</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
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
