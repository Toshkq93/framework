<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Файл:     block.auth.php
 * Тип:     block
 * Имя:     auth
 * Назначение:  проверяет авторизован ли пользователь
 * -------------------------------------------------------------
 */
function smarty_block_auth($params, $content, &$smarty)
{
    if ($content) {
        if (app(\Core\Auth\Auth::class)->check() === true){
            return $content;
        }

        return  false;
    }
}