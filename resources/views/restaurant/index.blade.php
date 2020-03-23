@extends('layouts.app')
@section('content')
<div class="container m-5">
  <div class="card">
    <div class="card-body">
      <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#myModal">создать</button>
      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Картинка</th>
            <th scope="col">Название</th>
            <th scope="col">Кухня</th>
            <th scope="col">Описание</th>
            <th scope="col">Ссылка</th>
          </tr>
        </thead>
        <tbody>
          @foreach($restaurants as $restaurant)
            <tr>
            <th scope="row">{{ $restaurant->id }}</th>
              <td><img src ="{{ $restaurant->image }}" width="40px" height="40px"></td>
              <td>{{ $restaurant->name }}</td>
              <td>{{ $restaurant->cuisine }}</td>
              <td>{{ $restaurant->options }}</td>
              <td><a href="https://astana.restoran.kz/{{ $restaurant->link }}">{{ $restaurant->name }}</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="container">
      {{ $restaurants->links() }}
    </div>
  </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('restaurant.create') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Название</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите название">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Кухня</label>
            <input type="text" name="cuisine" class="form-control" id="exampleInputPassword1" placeholder="Кухня">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Опции</label>
            <textarea name="options" class="form-control" id="exampleInputPassword1"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Картинка</label>
            <input type="file" name="image" class="form-control" id="exampleInputPassword1">
          </div>
          <button type="submit" class="btn btn-primary">создать</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection