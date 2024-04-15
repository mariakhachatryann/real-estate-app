<x-layout>
        <!-- Titlebar
        ================================================== -->
        <div id="titlebar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <h2>Log In & Register</h2>

                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Log In & Register</li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>


        <!-- Contact
        ================================================== -->

        <!-- Container -->
        <div class="container">

            <div class="row">
                <div class="col-md-4 col-md-offset-4">

                    <button class="button social-login via-twitter"><i class="fa fa-twitter"></i> Log In With Twitter</button>
                    <button class="button social-login via-gplus"><i class="fa fa-google-plus"></i> Log In With Google Plus</button>
                    <button class="button social-login via-facebook"><i class="fa fa-facebook"></i> Log In With Facebook</button>

                    <!--Tab -->
                    <div class="my-account style-1 margin-top-5 margin-bottom-40">

                        <ul class="tabs-nav">
                            <li class=""><a href="#tab1">Log In</a></li>
                            <li><a href="#tab2">Register</a></li>
                            <li><a href="#tab3">Admin Login</a></li>
                        </ul>

                        <div class="tabs-container alt">

                            <!-- Login -->
                            <div class="tab-content" id="tab1" style="display: none;">
                                <form action="{{ route('login') }}" method="post" class="login">
                                    @csrf
                                    <p class="form-row form-row-wide">
                                        <label for="username">Username:
                                            <i class="im im-icon-Male"></i>
                                            <input type="text" class="input-text" name="username" id="username" value="" />
                                        </label>
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="password">Password:
                                            <i class="im im-icon-Lock-2"></i>
                                            <input class="input-text" type="password" name="password" id="password"/>
                                        </label>
                                    </p>

                                    <p class="form-row">
                                        <input type="submit" class="button border margin-top-10" name="login" value="Login" />

                                        <label for="rememberme" class="rememberme">
                                            <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label>
                                    </p>

                                    <p class="lost_password">
                                        <a href="#" >Lost Your Password?</a>
                                    </p>

                                </form>
                            </div>

                            <!-- Register -->
                            <div class="tab-content" id="tab2" style="display: none;">

                                <form action="{{ route('register') }}" method="post" class="register">
                                    @csrf

                                    <p class="form-row form-row-wide">
                                        <label for="username2">Username:
                                            <i class="im im-icon-Male"></i>
                                            <input type="text" class="input-text" name="username_reg" id="username2" value="" />
                                        </label>
                                        @error('username_reg')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="email2">Email Address:
                                            <i class="im im-icon-Mail"></i>
                                            <input type="text" class="input-text" name="email_reg" id="email2" value="" />
                                        </label>
                                        @error('email_reg')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="password1">Password:
                                            <i class="im im-icon-Lock-2"></i>
                                            <input class="input-text" type="password" name="password_reg" id="password1"/>
                                        </label>
                                        @error('password_reg')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="password2">Repeat Password:
                                            <i class="im im-icon-Lock-2"></i>
                                            <input class="input-text" type="password" name="password_reg_confirmation" id="password2"/>
                                        </label>
                                    </p>

                                    <p class="form-row">
                                        <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />
                                    </p>
                                </form>
                            </div>

                            <div class="tab-content" id="tab3" style="display: none;">
                                <form action="{{ route('admin.login') }}" method="post" class="login">
                                    @csrf
                                    <p class="form-row form-row-wide">
                                        <label for="name">Admin name:
                                            <i class="im im-icon-Male"></i>
                                            <input type="text" class="input-text" name="name" id="name" value="" />
                                        </label>
                                    </p>

                                    <p class="form-row form-row-wide">
                                        <label for="password">Password:
                                            <i class="im im-icon-Lock-2"></i>
                                            <input class="input-text" type="password" name="password" id="password"/>
                                        </label>
                                    </p>

                                    <p class="form-row">
                                        <input type="submit" class="button border margin-top-10" name="login" value="Login" />
                                    </p>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

</x-layout>
<!-- Wrapper -->

