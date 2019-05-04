
@extends('base')


@section('main')
<div class="col-sm-12">

  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>



<div class="row">
<div class="col-sm-12">
    <h1 class="display-3 text-right ">البيانات</h1>  
    <div class= "container"> 


    <form> 
        <select name='type' id="search-type" class="form-control col-md-4 " style=" float: right;" >
            <option  value=''> طريقة البحث </option>
            <option value='ID'> الرقم التعريفي </option>
            <option value='Number'> رقم الهاتف </option>
            <option value='Name'> بالاسم </option>
        </select>

      <div class="form-group" id="search-input-div" style="margin-top: 25px;">
          <input class="form-control col-md-4" type="text" id="search-input"   style=" float: right; margin-right:7px;">
          <button class="btn btn-primary "  id="search-button"  style="margin: 19px;"> بحث </button>
      </div>
    </form>


    <a style="margin: 19px;" href="{{ route('contacts.create')}}" class="btn btn-primary">اضافة جديد</a>
</div>
<div class="container col-sm-12 text-right">    
  <table class="table table-striped col-sm-12 float-right table-responsive">
    <thead>
        <tr>
        <td colspan = 2>العمليات</td>

          <td class="d-none d-lg-block  text-right">المسمي الوظيفي</td>
          <td class="">الاسم</td>
          <td class="d-none d-lg-block">الاميل</td>

          <td>رقم التليفون</td>
          <td>الرقم التعريفي</td>
        </tr>
    </thead>
    <tbody id="table-result">
        @foreach($contacts as $contact)
        <tr>
        <td>
                <a href="{{ route('contacts.edit',$contact->id)}}" class="btn btn-primary">تعديل</a>
            </td>
            <td>
                <form action="{{ route('contacts.destroy', $contact->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">حذف</button>
                </form>
            </td>
            <td class="d-none d-lg-block">{{$contact->job_title}}</td>
            <td>{{$contact->name}}</td>
            <td class="d-none d-lg-block">{{$contact->email}}</td>

            <td>{{$contact->phone}}</td>
            <td>{{$contact->id}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('script')
  <script>
  $(document).ready(function(){
    
    $('#search-input-div').hide()
   
    $('#search-type').on('change',function(){
        $('#search-input-div').show()
      });

     $('#search-button').on('click',function(event){
      event.preventDefault()  ;
      var type =   $('#search-type').val();
      var data =   $('#search-input').val();

      if( type !='' && data != ''){
        $.ajax({
          type:"GET",
          url:"/contacnts/search",
          dataType:'json',
          data:{type:type,data:data},
          success: function (response) {
            // alert(response);
            $('#table-result').html("")

            console.log(response);
            if(response.contacts.length>0){
              $.each(response.contacts, function(i, item){
              var $tr = $('<tr>').append(
                $('<td>').text(""),

                // $('<td>').append($("<a href="{{ route('contacts.edit',$contact->id)}}" class="btn btn-primary">تعديل</a>")),
                $('<td "><a href="{{ route('contacts.edit',$contact->id)}}" class="btn btn-primary">تعديل</a>'),
                $('<td class="d-none d-lg-block">').text(item.job_title),
                $('<td>').text(item.name),
                $('<td class="d-none d-lg-block"> ').text(item.email),

                $('<td>').text(item.phone),
                $('<td>').text(item.id),
                // $('<td>').html"( <button class="btn btn-danger" type="submit">Delete</button>)"
              )
              $('#table-result').append($tr)
            });

            }else{
              
              var $tr = $('<tr>').append(
                $('<th colspan="5">').text(response.message),
              )  
              $('#table-result').append($tr) ;
            }
            
          },
          error:function(err){
            console.log(err);
          }
        });
      }
     }); 
  }) 
    
  </script>
@stop