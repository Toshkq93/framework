{if $flash->has('error')}
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="alert alert-danger">
                {$flash->get('error')}
            </div>
        </div>
    </div>
{/if}
{if $flash->has('success')}
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="alert alert-success">
                {$flash->get('success')}
            </div>
        </div>
    </div>
{/if}