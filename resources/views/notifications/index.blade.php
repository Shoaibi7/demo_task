@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Notifications</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <!-- Filter Form -->
        <form action="{{ route('notifications.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if(request('role') == $role->id) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ request('email') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </div>
        </form>

       <!-- Notification Form -->
       <form action="{{ route('admin.notifications.send') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usersAndCompanies as $userOrCompany)
                    <tr>
                        <td>{{ $userOrCompany->name }}</td>
                        <td>{{ $userOrCompany->email }}</td>
                        <td>{{ $userOrCompany->role['name'] }}</td>
                        <td>
                            <!-- Checkbox to select users -->
                            <input type="checkbox" name="selectedUsers[]" value="{{ $userOrCompany->id }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mb-3">
            <label for="notification_subject">Notification Subject:</label>
            <input type="text" name="notification_subject" id="notification_subject" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="notification_body">Notification Body:</label>
            <textarea name="notification_body" id="notification_body" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Notification</button>
    </form>
    </div>
@endsection
