<div class="row justify-content-center">
    <h1>Register: </h1>
    <div class="col-6">
        <form action="{get_route name='auth.signup'}" method="POST">
            {csrf}
            <div class="form-group mt-2">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control {if $errors && $errors.email}is-invalid{/if}">
                {if $errors && $errors.email}
                    <div class="invalid-feedback">
                        {$errors.email}
                    </div>
                {/if}
            </div>
            <div class="form-group mt-2">
                <label for="email">First name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control {if $errors && $errors.first_name}is-invalid{/if}">
                {if $errors && $errors.first_name}
                    <div class="invalid-feedback">
                        {$errors.first_name}
                    </div>
                {/if}
            </div>
            <div class="form-group mt-2">
                <label for="email">Last name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control {if $errors && $errors.last_name}is-invalid{/if}">
                {if $errors && $errors.last_name}
                    <div class="invalid-feedback">
                        {$errors.last_name}
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
            <div class="form-group">
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" name="password_confirmation" class="form-control {if $errors && $errors.password_confirmation}is-invalid{/if}" id="password_confirmation">
                {if $errors && $errors.password_confirmation}
                <div class="invalid-feedback">
                    {$errors.password_confirmation}
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