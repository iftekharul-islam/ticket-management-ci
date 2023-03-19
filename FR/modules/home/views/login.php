    <main class="login static-background">
        <div class="login-form">
            <form action="user/login"  method="post" accept-charset="utf-8">
                <h2 class="text-center mb-4">SIGN IN</h2>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="lni-envelope"></i></div>
                        </div>
                        <input class="form-control" type="email" placeholder="Email" name="identity" required aria-required="true">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="lni-key"></i></div>
                        </div>
                        <input class="form-control" type="password" placeholder="Password" name="password" required aria-required="true">
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-gradient">LOGIN <i class="lni-arrow-right-circle"></i></button>
                </div>
            </form>
        </div>
    </main>
