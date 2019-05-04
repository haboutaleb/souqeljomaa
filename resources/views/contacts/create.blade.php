@extends('base')

@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3  text-right">اضافة اسم</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('contacts.store') }}">
          @csrf
          <div class="form-group  text-right">    
              <label for="name"> :الاسم</label>
              <input type="text" class="form-control  text-right" name="name"/>
          </div>

          <div class="form-group  text-right">
              <label for="phone"> :رقم الهاتف</label>
              <input type="text" class="form-control  text-right" name="phone"/>
          </div>

          <div class="form-group  text-right">
              <label for="job_title">:المسمي الوظيفي</label>
              <input type="text" class="form-control  text-right" name="job_title"/>
          </div>  
          
          <div class="form-group  text-right">
              <label for="email"> :الاميل</label>
              <input type="text" class="form-control  text-right" name="email"/>
          </div>
                       
          <button type="submit" class="btn btn-primary text-center float-right btn-block">اضافة</button>
      </form>
  </div>
</div>
</div>
@endsection