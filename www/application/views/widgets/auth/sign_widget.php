<div class="signBlock">
	<div class="signDoor" onclick="application.showSignIn($(this))"><span>вход</span></div> <!-- раскрытое состояние  class="signDoor show" -->
	<div class="registDoor" onclick="application.showRegister($(this))"><span>регистрация</span></div>
	<!--вход-->
	<div class="sign _popup"> <!-- style="display: block;" -->
		<div class="iForms">
			<div class="iField">
				<label for="flogin" class="_autohide">E-mail</label>
				<input type="text" value="" id="login_email" onkeydown="monitorEnter(event, this, function() { $('#login_pass').focus() })" />
			</div>
			<div class="iField">
				<label for="fpass" class="_autohide">Пароль</label>
				<input type="password" value="" id="login_pass" onkeydown="monitorEnter(event, this, application.login)" />
			</div>
			<div class="forget" style="display: none"><a href="#">Забыли пароль?</a></div>
			<label for="remember" class="remember"><input type="checkbox" value="" id="remember" />Запомнить меня</label>
			<div class="but"><input type="button" value="войти" class="ibutton" onclick="application.login()"/></div>
			<div class="iField" id="login_status"></div>
		</div>
	</div>
	<!--/вход-->
	<!--регистрация-->
	<div class="registration _popup">
		<div class="iForms">
			<div class="iField">
				<label for="flogin" class="_autohide">E-mail</label>
				<input type="text" value="" id="reg_email" onkeydown="monitorEnter(event, this, function() { $('#reg_name').focus() })"/>
				<small>Будет использоваться для входа (login)</small>
			</div>
			<div class="iField">
				<label for="fname" class="_autohide">Имя</label>
				<input type="text" value="" id="reg_name" onkeydown="monitorEnter(event, this, function() { $('#reg_pass').focus() })" />
				<small>Будет отображаться на сайте</small>
			</div>
			<div class="iField">
				<label for="fpass" class="_autohide">Пароль</label>
				<input type="password" value="" id="reg_pass" onkeydown="monitorEnter(event, this, function() { $('#reg_captcha').focus() })"/>
			</div>
			<div class="iField">
				<div id="captcha"><img src='/captcha/default'/></div>
				<div class="code">
					<a href="javascript:void();" onclick="application.updateCaptcha()">Обновить</a>
					<input type="text" value="" id="reg_captcha" onkeydown="monitorEnter(event, this, application.register)"/>
				</div>
				<small>Защита от роботов</small>
			</div>
			<div class="but"><input type="button" value="регистрация" class="ibutton" onclick="application.register()"/></div>
			<div class="iField" id="reg_status"></div>
		</div>

	</div>
	<!--/регистрация-->
</div>
<script language="javascript" type="text/javascript">
	$().ready(
	function()
	{
		application.updateCaptcha();
	});
</script>
