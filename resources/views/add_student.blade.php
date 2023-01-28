<!DOCTYPE html>
@extends('layout')

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Dependent AJAX Dropdown Tutorial</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">

      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="/">Home</a></li>
          <li class="active"><a href="/students-list">Students List</a></li>
          <li class="active"><a href="/add-students">Add Students</a></li>
        </ul>
      </div>
    </div>
  </nav>

 
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                 <div class="container">
                <form>
                  <div class="container" style="background-color:white">
 <button id="btn">Add row</button>
          <table border="1" class="table table-hover">
            <thead>
              <th>Sl No</th>
              <th>Name</th>
              <th>Country</th>
              <th>Stae</th>
              <th>Image</th>
              
            </thead>
         
            <tbody>
            
              <tr>
                <td>1</td>
                <td><input type="text" class="form-control" placeholder="First name"></td>
                <td><select  id="country-dd" class="form-control">
                            <option value="">Select Country</option>
                            @foreach ($countries as $data)
                            <option value="{{$data->id}}">
                                {{$data->name}}
                            </option>
                            @endforeach
                        </select></td>
                <td><div class="form-group mb-3">
                        <select id="state-dd" class="form-control">
                        </select>
                    </div></td>
                <td> <input type="file" id="myFile" name="filename"></td>
  
              </tr>
              
            
              
            </tbody>
          </table>
        </div>
                </form>
              </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    url: '{{url('fetch-states')}}',
                    type: "POST",
                    dataType: "json",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                  console.log("Hello world!");
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                       
                    }
                });
            });


        });


        var count=1;
$("#btn").click(function(){
   console.log(count);
   addNewRow(count);
  // $("#container").append(addNewRow(count));
  count++;
});

function addNewRow(count){
   console.log("Hello worlddd!");
  var newrow='<div class="row">'+
    '<div class="col-md-4">'+
        '<div class="form-group label-floating">'+
            '<label class="control-label">Name '+count+'</label>'+
            '<input type="text" class="form-control" v-model="act" >'+
        '</div>'+
    '</div>'+
    '<div class="col-md-4">'+
        '<div class="form-group label-floating">'+
            '<label class="control-label">Position '+count+'</label>'+
            '<input type="text" class="form-control" v-model="section">'+
        '</div>'+
    '</div>'+    
'</div>';
  return newrow;
}
    </script>


</body>

</html>