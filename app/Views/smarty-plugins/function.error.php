<?php

use Core\Contracts\SessionInterface;

function smarty_function_error($params, &$smarty)
{
    $session = app(SessionInterface::class);

    if ($session->exists('errros') && $session->exists('errors' . $params['name'])) {
        dd($session);
    }
}