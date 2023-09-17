@extends('admin.main-page')

@section('title', "Список email клиентов")

@section('content')

@if(session('successCreateEmail'))

<div class="alert alert-success">
    {{session('successCreateEmail')}}
</div>
    
@endif
    <h3 class="text-center mb-4">Список email клиентов</h3>
    <div class="d-flex justify-content-end">
        <a  role="button" class="btn btn-info btn-sm mb-3" href="{{route('create.emails')}}">Добавить email</a>
      </div>
    <div class="row">
        <div class="col-6 col-md-12 border d-flex justify-content-center flex-column">
          @if($emails->count() == 0)
          <h5 class="text-center text-danger">Пока нет ни одного email!</h5>
          @else         
          <table class="table table-hover ">
              <thead>
                  <tr>                      
                      <th scope="col">ID</th>
                      <th scope="col">ФИО</th>
                      <th scope="col">Email</th>
                      <th scope='col'>Действия</th>                                           
                  </tr>
              </thead>
              <tbody>
                  @foreach ($emails as $email)
                      <tr>
                          <td>{{ $email->id }}</td>
                          <td>{{ $email->last_name }} {{ $email->first_name }}</td>
                          <td>{{ $email->email }}</td>
                          <td>
                            <div class="d-flex">
                                <a href="{{route('edit.emails', $email->id)}}">
                                    <img  width="20" height="20" class="img-profile mx-2" src="{{ asset('assets/img/icon-edit.png') }}">
                                </a>
                                <form action="{{route('delete.emails', $email->id)}}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-light btn-sm" onclick='event.preventDefault();
                                    if(confirm("Email: {{$email->email}} будет удален! Продолжить?")){
                                                this.closest("form").submit();
                                            }'>
                                    <img  width="20" height="20" class="img-profile" src="{{ asset('assets/img/icon-delete.png') }}">
                                    </button>
                                </form>
                            </div>
                            
                            
                        </td>                                                    
                      </tr>
                  @endforeach
              </tbody>
          </table>           
        </div>
        @endif
    </div>
@endsection