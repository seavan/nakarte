<link rel="stylesheet" type="text/css" href="./css/main.css" />

<?
	$conf = Kohana::config('photos');
?>

<div id="mainwrap" class="widthSite">
		<div class="block1">
			&nbsp;
		</div>
		<div class="block2">
			<div class="profileBlock">
			<!--личная-->
				<dl class="personalBlock">
					<dt>
						<?=$user->firstname?>
						<span>Был(а) на сайте <?=$last_login?></span>
					</dt>
					<dd>
					    <? if (isset($user->avatar_guid)) {?>
						<img src='<?=$conf['avatars_path'].$user->avatar_guid?>.thumb.jpg'  alt="" />
                        <? ; } 
						else {?>
						<img src='<?=$conf['avatars_stand_path']?>avatar_mid.png'  alt="" />
						<? ; } ?>
						<!--статус-->
							<div class="iStatus" id="editableStatus">
								<ins><span class="editInPlace" style="height: 14px;"><label for="editInPlace1" style="display: block;"><?=$user->mood?></label><textarea id="editInPlace1" spellcheck="false" style="left: -1px; height: 14px;"></textarea></span></ins>
							</div>
						<!--/статус-->

						<div class="descr">
							<span>Откуда:</span> Казахстан<?=$user_city?><br />
							<span>email: </span> <a href="#"><?=$user->email?></a><br />
							<span class="icq">icq:</span> <?=$user->icq?>
						</div>
						<ul class="action">
							<li class="addFriend"><span>добавить в друзья</span></li>
							<li class="sendMes"><a href="#">написать сообщение</a></li>
						</ul>
					</dd>
				</dl>
			<!--/личная-->
			<!--места-->
				<div class="placeUser">
					<div class="listBlock">
						<!---->
						<div class="block placeList">
							<h2 class="title"><a href="#">Любимые места</a> <span>(<?=count($user_favorite_obj)?>)</span></h2>
							<ul class="list">
							<?
									if (isset($user_favorite_obj)) {
									for ($i=1; $i<=(count($user_favorite_obj)); $i++) { ?>
								<li>
									<a href="#" class="name"><?=$favorite_caption[$i]?></a>
									<?=$favorite_address[$i]?>
									<div class="general_cont">
										<div class="rating">
											<div><span style="width:50%">&nbsp;</span></div>
											<span class="value"><?=$favorite_vote[$i]?></span>
										</div>
										<a href="#" class="comment"><?=$count_comment[$i]?></a>
									</div>
								</li>
								<? ;   } }?>
							</ul>
							<a href="#" class="more">все места</a>
						</div>
						<!--/-->
						<!---->
						<div class="block placeList">
							<h2 class="title"><a href="#">Побывал</a> <span>(<?=count($user_been_obj)?>)</span></h2>
							<ul class="list">
							<?
									if (isset($user_been_obj)) {
									for ($i=1; $i<=(count($user_been_obj)); $i++) { ?>
								<li>
									<a href="#" class="name"><?=$been_caption[$i]?></a>
									<?=$been_address[$i]?>
									<div class="general_cont">
										<div class="rating">
											<div><span style="width:50%">&nbsp;</span></div>
											<span class="value"><?=$been_vote[$i]?></span>
										</div>
										<a href="#" class="comment"><?=$count_comment_been[$i]?></a>
									</div>
								</li>
                                <? ;   } }?>	
															
							<a href="#" class="more">все места</a>
						</div>
						<!--/-->
					</div>
				</div>
			<!--/места-->
			<!--друзья/фотки-->
				<div class="placeUser">
					<div class="listBlock">
						<!---->
							<div class="block peopleBlock">
								<h2 class="title"><a href="#">Друзья</a> <span>(<?=count($user_friends)?>)</span></h2> 

								<div class="list">
									<?
									$n = 10;  // кол-во аватарок друзей для вывода
									if ((count($all_photos_user)!==0)&&(isset($friend_avatar))) {
									if (count($friend_avatar)<=$n) $n = count($friend_avatar); 
				
									for ($i=1; $i<=$n; $i++) { ?>
									<a href="#"><img alt="" src='<?=$conf['avatars_path'].$friend_avatar[$i]?>.thumb.jpg'></a>
									<? ;   } }?>
									<? if (count($friend_avatar)>=$n) {?>
									<a href="#" class="more">...</a>
									<? ; } ?>
								</div>
								<a href="#" class="more">все друзья</a>
							</div>
						<!--/-->
						<!---->
						<div class="block photoList">
							<h2 class="title"><a href="#">Фотографии</a> <span>(<?=count($photos)?>)</span></h2>
							<div class="list">
								<?
								$k = 2;  // кол-во фоток пользователя для вывода
								if ((count($all_photos_user)!==0)&&(isset($all_photos_user))) {
								if (count($all_photos_user)<=$k) $k = count($all_photos_user); 
								for ($i=1; $i<=$k; $i++) { ?>
								<a href='/photos/id/<?=$all_photos_user[$i]?>'><img alt="" src='<?=$conf['photo_path'].$all_photos_user[$i]?>.thumb.jpg'></a>
								<? ;   } } ?>
								<? if (count($all_photos_user)>=$k) {?>
								<a href="#" class="more">...</a>
								<? ; } ?>
							</div>
							<a href="#" class="more">все фото</a>
						</div>
						<!--/-->
					</div>
				</div>
			<!--/друзья/фотки-->
			</div>
		</div>
	</div>