<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="box">
    <div style="background: white; padding: 1em;">
        <h3>Зарегистрироваться</h3>
        <?php print form::open("auth/register") ?>
        <p>E-Mail<sup>*</sup>:<span class="error"><?php print (empty ($errors['email'])) ? '' : $errors['email']; ?></span><br/>
            <?php print form::input('email', $form['email']); ?>
        </p>
        <p>Пароль<sup>*</sup>:<span class="error"><?php print (empty ($errors['pass'])) ? '' : $errors['pass']; ?></span><br/>
        <?php print form::password('pass');?>
        </p>
        <p>Повторите пароль<sup>*</sup>:<br/>
            <?php print form::password('pass_repeat');
            ?>
        </p>
        <p>Имя<sup>*</sup>:<span class="error"><?php print (empty ($errors['name'])) ? '' : $errors['name']; ?></span><br/>
            <?php print form::input('name', $form['name']); ?>
        </p>
        <p>Фамилия:<br/>
            <?php print form::input('surname', $form['surname']);
            print (empty ($errors['surname'])) ? '' : $errors['surname']; ?>
        </p>
        <p>Ваш город<sup>*</sup>:<span class="error"><?php print (empty ($errors['city'])) ? '' : $errors['city']; ?></span><br/>
            <?php print form::dropdown('city', $cities, $form['city']); ?>
        </p>

        <div style="text-align:center">
            <?php print form::submit('send', 'Зарегистрироваться') ?>
        </div>
        <?php print form::close() ?>
    </div>
</div>
