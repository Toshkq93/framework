<div class="row justify-content-center">
    <h1>Login: </h1>
    <div class="col-6">
        <form action="{get_route name='auth.signin'}" method="POST">
            <div class="form-group mt-2">
                <label for="email">Email:</label>
                {error name='email'}
                <input type="text" name="email" id="email" class="form-control {if $errors && $errors.email}is-invalid{/if}">
                {if $errors && $errors.email}
                    <div class="invalid-feedback">
                        {$errors.email}
                    </div>
                {/if}
            </div>
            <div class="form-group mt-2">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password"
                       class="form-control {if $errors && $errors.password}is-invalid{/if}">
                {if $errors && $errors.password}
                    <div class="invalid-feedback">
                        {$errors.password}
                    </div>
                {/if}
            </div>
            <div class="form-check mt-2">
                <label for="remember" class="form-check-label">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    Remember me
                </label>
            </div>
            <button class="btn btn-primary mt-2">Sign in</button>
        </form>
    </div>
</div>