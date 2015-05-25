<?= form::open() ?>
<table>
    <tr>
        <td><?= form::label('email', 'E-mail') ?></td>
        <td><?= form::input('email') ?></td>
    </tr>
    <tr>
        <td><?= form::label('name', 'Имя') ?></td>
        <td><?= form::input('name') ?></td>
    </tr>
    <tr>
        <td><?= form::label('pass', 'Пароль') ?></td>
        <td><?= form::password('pass') ?></td>
    </tr>
    <tr>
        <td><?= form::label('pass_repeat', 'Ещё раз пароль') ?></td>
        <td><?= form::password('pass_repeat') ?></td>
    </tr>
    <tr>
        <td colspan="2"><?= form::submit('register', 'Зарегистрироваться') ?></td>
    </tr>
</table>
<?= form::close() ?>
