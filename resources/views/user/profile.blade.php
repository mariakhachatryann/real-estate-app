<x-layout>

    <!-- Titlebar
    ================================================== -->
    <div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>My Profile</h2>

                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>My Profile</li>
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


            <!-- Widget -->
            @include("components.manageAcc")

            <div class="col-md-8">
                <div class="row">

                    @if (session('success'))
                        <p>{{ session('success') }}</p>
                    @endif

                    <form method="post" action="{{ route('update') }}" class="col-md-8 my-profile">
                        @csrf
                        <h4 class="margin-top-0 margin-bottom-30">My Account</h4>

                        <label>Your Name</label>
                        <input name="username" value="{{ $user->username }}" type="text">

                        <label>Your Title</label>
                        <input name="title" value="{{ $user->title }}" type="text">

                        <label>Phone</label>
                        <input name="phone" value="{{ $user->phone }}" type="text">

                        <label>Email</label>
                        <input name="email" value="{{ $user->email }}" type="text">


                        <h4 class="margin-top-50 margin-bottom-25">About Me</h4>
                        <textarea name="about" name="about" id="about" cols="30" rows="10">{{ $user->about }}</textarea>


                        <h4 class="margin-top-50 margin-bottom-0">Social</h4>

                        <label><i class="fa fa-twitter"></i> Twitter</label>
                        <input name="tw" value="{{ $user->tw }}" type="text">

                        <label><i class="fa fa-facebook-square"></i> Facebook</label>
                        <input name="fb" value="{{ $user->fb }}" type="text">

                        <label><i class="fa fa-google-plus"></i> Google+</label>
                        <input name="google" value="{{ $user->google }}" type="text">

                        <label><i class="fa fa-linkedin"></i> Linkedin</label>
                        <input name="linkedin" value="{{ $user->linkedin }}" type="text">


                        <button type="submit" class="button margin-top-20 margin-bottom-20">Save Changes</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-layout>
