<?php

function smarty_function_csrf()
{
    $csrf = app(\Core\Csrf::class);

    return '<input type="hidden" name="' . $csrf->key() . '" value="' . $csrf->token() . '">';
}