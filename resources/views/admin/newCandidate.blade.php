@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a New Candidate</div>

                <div class="card-body">
                    <a href="{{ route('dashboard') }}">Back to Dashboard</a>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('store.candidate') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="walterID">Walter ID</label>
                            <input class="form-control {{$errors->has('walterID') ? 'alert alert-danger' : ''}}" type="text" name="walterID" id="walterID" placeholder="..." value="{{old('walterID')}}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="firstName">First Name</label>
                                <input class="form-control {{$errors->has('firstName') ? 'alert alert-danger' : ''}}" type="text" name="firstName" id="firstName" placeholder="..." value="{{old('firstName')}}">
                            </div>

                            <div class="form-group col">
                                <label for="lastName">Last Name</label>
                                <input class="form-control {{$errors->has('lastName') ? 'alert alert-danger' : ''}}" type="text" name="lastName" id="lastName" placeholder="..." value="{{old('lastName')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email (Optional)</label>
                            <input class="form-control {{$errors->has('email') ? 'alert alert-danger' : ''}}" type="email" name="email" id="email" placeholder="..." value="{{old('email')}}">
                        </div>

                        <div class="form-group">
                            <label for="locationPreference">Location Preference (Optional)</label>
                            <input class="form-control {{$errors->has('locationPreference') ? 'alert alert-danger' : ''}}" type="text" name="locationPreference" id="locationPreference" placeholder="..." value="{{old('locationPreference')}}">
                        </div>

                        <div class="form-group">
                            <label for="phone">Job Title</label>
                            <input class="form-control {{$errors->has('jobTitle') ? 'alert alert-danger' : ''}}" type="text" name="jobTitle" id="jobTitle" placeholder="current or desired position..." value="{{old('jobTitle')}}">
                        </div>

                        <div class="form-group">
                            <label for="industry">Industry</label>
                            <input class="form-control {{$errors->has('industry') ? 'alert alert-danger' : ''}}" type="text" name="industry" id="industry" placeholder="working in..." value="{{old('industry')}}">
                        </div>

                        <div class="form-group">
                            <label for="summary">Summary</label>
                            <textarea class="form-control {{$errors->has('summary') ? 'alert alert-danger' : ''}}" rows="3" name="summary" id="summary" placeholder="candidate position description...">{{ old('summary') }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Add to Candidates</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection