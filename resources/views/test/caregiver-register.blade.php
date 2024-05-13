@extends('kindercare.layout')
@section('title', 'Registration')
@section('content')
    <div class="container">
        <form action="{{route('register.post')}}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">IC Number</label>
                <input type="text" class="form-control" name="ic_number" value="{{ old('ic_number') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone number</label>
                <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" class="form-control" name="status" value="{{ old('status', 'ACTIVE') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <input type="text" class="form-control" name="role" value="{{ old('role', 'CAREGIVER') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
