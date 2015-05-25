<div>
    <?php if(Auth::instance()->logged_in()): ?>
    Вход выполнен,
    <?php echo Auth::instance()->get_user()->username ?>. <?php print html::anchor("welcome/logout", 'Выйти')?>.
    <?php else: ?>
    Вход не выполнен. <?php print html::anchor("welcome", 'Войти')?>, <?php print html::anchor("auth/register", 'Регистрация')?>.
    <?php endif ?>
</div>