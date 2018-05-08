@extends('layouts.admin')

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNew">
      <i class="fa fa-plus"></i> Add New
    </button>
    <h1>Users</h1>
    <table class="table table-striped dataTable">
        <thead class="thead-inverse">
            <tr>
                <th width="10">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th width="250">Timestamps</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    <a href="/admin/users/{{ $user->id }}/edit">{{ $user->name }}</a><br>
                    <small>{{ $user->username }}</small>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <small>
                        Created at: {{ Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('jS F Y g:ia') }}<br />
                        Updated at: {{ Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->format('jS F Y g:ia') }}<br />
                        ({{ Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->diffForHumans() }})
                    </small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="POST" action="{{ url('admin/users') }}">
        {{ csrf_field() }}
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
              </div>
            </div>
        </form>
      </div>
    </div>
@endsection
