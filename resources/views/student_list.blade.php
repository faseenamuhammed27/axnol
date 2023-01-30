<!DOCTYPE html>
@extends('layout')

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

  <div class="container-fluid text-center">
    <div class="row content">
        <div class="container">
          <h2>Students List</h2>
        </div>
        <!-- Session message holder -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
        @endif

        <div class="container" style="background-color:white">
          <table border="1" class="table table-hover">
            <thead>
              <th>Sl No</th>
              <th>Name</th>
              <th>Country</th>
              <th>Stae</th>
              <th>Image</th>
              
            </thead>
            @if(count($data) > 0)
            <tbody>
              @foreach($data as $key=>$item)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{ucfirst($item->name)}}</td>
                <td>{{$item->cname}}</td>
                <td>{{$item->sname}}</td>
                <td> <img class="coupons" src="'.$item->image.'"/>'</td>
  
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="6" class="text-center">No Data Found</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
     
        </form>
      </div>
    </div>
  </div>

</body>

</html>