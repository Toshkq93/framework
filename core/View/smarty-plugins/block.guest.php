<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Файл:     block.guest.php
 * Тип:     block
 * Имя:     guest
 * Назначение:  проверяет гость ли пользователь
 * -------------------------------------------------------------
 */
function smarty_block_guest($params, $content, &$smarty)
{
    if ($content) {
        if (app(\Core\Auth\Auth::class)->check() === false){
            return $content;
        }
        return  false;
    }
}