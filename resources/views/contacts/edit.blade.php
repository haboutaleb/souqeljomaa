@extends('base') 
@section('main')
<div class="row text-right">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">تحديث البيانات</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('contacts.update', $contact->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="name">الاسم:</label>
                <input type="text" class="form-control text-right" name="name" value={{ $contact->name }} />
            </div>

            <div class="form-group">
                <label for="last_name">رقم التليفون:</label>
                <input type="text" class="form-control text-right" name="phone" value={{ $contact->phone }} />
            </div>

            <div class="form-group">
                <label for="job_title">المسمي الوظيفي:</label>
                <input type="text" class="form-control text-right" name="job_title" value={{ $contact->job_title }} />
            </div>

            <div class="form-group">
                <label for="email">الاميل:</label>
                <input type="text" class="form-control text-right" name="email" value={{ $contact->email }} />
            </div>
          
          
     
            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>
    </div>
</div>
@endsection