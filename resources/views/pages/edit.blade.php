@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="text-center mt-5">Student Management</h3>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="form-area">
                    <form method="POST" action="{{ route('student.update', $student->id) }}">
                        {!! csrf_field() !!}
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <label>Student Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $student->name }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Student DOB</label>
                                <input type="date" class="form-control" name="dob" value="{{ $student->dob }}" required>
                                @error('dob')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $student->email }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="mobile_no" value="{{ $student->mobile_no }}" required>
                                @error('mobile_no')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <input type="submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            var maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate()).toISOString().split('T')[0];
            document.getElementById('dob').setAttribute('max', maxDate);
        });
    </script>
@endsection
