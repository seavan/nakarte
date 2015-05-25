<ul class="menuSearch">
	<li  class="cur">
		<div class="name">места <span>(<?= $this->get_city_stats()->poi_count ?>)</span></div>

		<div class="wrap searchPlaceBlock">
				<div class="cont">
					<div class="t">&nbsp;</div>
					<div class="in">

						<div class="field">
							<span class="h">Что</span>
							<div>
								<label for="searchwhat" class="_autohide">я хочу найти</label>
								<input type="text" id="searchwhat" onkeydown="monitorEnter(event, this, application.searchPlace)" />
							</div>
							<small>Например: <span onclick="$('#searchwhat').val($(this).text())">кафе</span></small>
						</div>
						<div class="field">
							<label for="searchwhere"  class="h">Где</label>
							<div><input type="text" id="searchwhere" value="" onkeydown="monitorEnter(event, this, application.searchPlace)"  /></div>
							<small>Например: <span onclick="$('#searchwhere').val($(this).text())">пр. Гагарина</span></small>
						</div>
						<input type="button" value="искать" class="ibutton" onclick="application.searchPlace()"/>


					</div>
				</div>
				<div class="b"><div>&nbsp;</div></div>
				<div class="ui-search-place-holder" style="display: none"></div>
		</div>
	</li>
	<li><div class="name">люди  <span>(<?= $this->get_user_count() ?>)</span></div>
	
	<div class="wrap searchPlaceBlock">
				<div class="cont">
					<div class="t">&nbsp;</div>
					<div class="in">

						<div class="field">
							<span class="h">Кто</span>
							<div>
								<label for="searchwho" class="_autohide">я хочу найти</label>
								<input type="text" id="searchwho" onkeydown="monitorEnter(event, this, application.searchUser)" />
							</div>
							<small>Например: <span onclick="$('#searchwho').val($(this).text())">Вова Сидоров</span></small>
						</div>						
						<input type="button" value="искать" class="ibutton" onclick="application.searchUser()"/>


					</div>
				</div>
				<div class="b"><div>&nbsp;</div></div>
				<div class="ui-search-place-holder" style="display: none"></div>
		</div>
	</li>
	
	<li><div class="name">фото  <span>(<?= $this->get_photo_count() ?>)</span></div></li>
</ul>