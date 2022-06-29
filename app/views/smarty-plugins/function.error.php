<?php

function smarty_function_error($params, &$smarty)
{
    $session = app(\Core\Contracts\SessionInterface::class);

    if ($session->exists('errros') && $session->exists('errors' . $params['name'])) {
        dd($session);
    }
}