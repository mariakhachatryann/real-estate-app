@extends('components.layout')
@section('layout')
    <!-- Titlebar
  ================================================== -->
    <div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>Change Password</h2>

                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Change Password</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>


    <!-- Content
    ================================================== -->
    <div class="container">
        <div class="row">
            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Widget -->
            @include('components.manageAcc')

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 my-profile">
                        <form action="{{ route('changePassword') }}" method="post">
                            @csrf
                            <h4 class="margin-top-0 margin-bottom-30">Change Password</h4>
                            <label for="current_password">Current Password</label>
                            <input id="current_password" type="password" name="current_password" required>

                            <label for="new_password">New Password</label>
                            <input id="new_password" type="password" name="new_password" required>

                            <label for="confirm_password">Confirm New Password</label>
                            <input id="confirm_password" type="password" name="confirm_password" required>

                            <button type="submit" class="margin-top-20 button">Save Changes</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="notification notice">
                            <p>Your password should be at least 12 random characters long to be safe</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
