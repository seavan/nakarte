<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="box">
    <table>
        <tr>
            <td>
                <p>Добро пожаловать на ресурс, посвященный сбору и обмену информацией о географических объектах на карте</p>

                <p>
		Если вы впервые на нашем сайте, то вы можете <a href="/auth/register">зарегистрироваться здесь</a><br />
                </p>
            </td>
            <td style="background: white; padding: 1em">
                <?php print form::open("welcome/login") ?>
                <p>Имя пользователя:<br/>
                    <?php print form::input('username') ?>
                </p>
                <p>Пароль:<br/>
                    <?php print form::password('pass') ?>
                </p>
                <div style="text-align:center">
                    <?php print form::submit('send', 'Вход') ?>
                </div>
                <?php print form::close() ?>
            </td>
        </tr>
    </table>
</div>
