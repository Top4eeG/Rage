@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Добавить фильтр постов</h5>
    <div class="card-body">
      <form method="post" action="{{route('post-tag.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Название</label>
          <input id="inputTitle" type="text" name="title" placeholder="Введите название"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Статус</label>
          <select name="status" class="form-control">
              <option value="active">Активен</option>
              <option value="inactive">Неактивен</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Сбросить</button>
           <button class="btn btn-success" type="submit">Подтвердить</button>
        </div>
      </form>
    </div>
</div>

@endsection
