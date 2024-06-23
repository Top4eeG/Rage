@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Добавить купон</h5>
    <div class="card-body">
      <form method="post" action="{{route('coupon.store')}}">
        {{csrf_field()}}
        <div class="form-group">
        <label for="inputTitle" class="col-form-label">Купон <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="code" placeholder="Введите купон"  value="{{old('code')}}" class="form-control">
        @error('code')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="type" class="col-form-label">Тип <span class="text-danger">*</span></label>
            <select name="type" class="form-control">
                <option value="fixed">Фиксированный</option>
                <option value="percent">Процентный</option>
            </select>
            @error('type')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputTitle" class="col-form-label">Значение <span class="text-danger">*</span></label>
            <input id="inputTitle" type="number" name="value" placeholder="Введите значение"  value="{{old('value')}}" class="form-control">
            @error('value')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Статус <span class="text-danger">*</span></label>
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
           <button class="btn btn-success" type="submit">Подтвердиь</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Напишите короткое описание.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush
