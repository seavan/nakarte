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
						<?=$user->getFullName()?>
						<span>Был(а) на сайте <?=$last_login?></span>
					</dt>
					<dd>
					<img src='<?=$user->avatar_url('mid')?>'  alt="" />					
						
						<!--статус-->
							<div class="iStatus" id="editableStatus">
								<ins><span class="editInPlace" style="height: 14px;">
								<label for="editInPlace1" style="display: block;"><?=$user->mood?></label>
								<textarea id="editInPlace1" spellcheck="false" style="left: -1px; height: 14px;" <?php if (!$own_profile){echo 'readonly="readonly"';}?>></textarea></span></ins>
							</div>
						<!--/статус-->

		
						<div class="descr">
							<span>Откуда:</span> Казахстан<?=$user_city?><br />
							<span>email: </span> <a href="mailto:<?=$user->email?>"><?=$user->email?></a><br />
							<span class="icq">icq:</span> <?=$user->icq?>
						</div>
						<? if (!$own_profile) {?>
						<ul class="action">
							<li class="addFriend"><span>добавить в друзья</span></li>
							<li class="sendMes"><a href="#">написать сообщение</a></li>
						</ul>
						<? };?>
					</dd>
					<dt><? if ($own_profile): ?>
						<a href="javascript:;" name='add_avatar' class="ibutton" onclick='$(this).next().slideToggle()'>изменить аватар</a>
						<div class="_photo_upload" style="clear: both; margin-bottom: 2em; display: none;">		
							<? if(isset($require_auth) && (!NakarteAuth::isLoggedIn())): ?>
								<p>Выполните вход для того, чтобы добавить фотографии.</p>
							<? else: ?>
								<? if (isset($user) ): ?>    
									<form enctype="multipart/form-data" action="profile/upload_avatar" method="post">
										<input name="avatar_guid" type="hidden" value="<?=$user->avatar_guid?>" />
										<input name="picture" type="file" />
										<input type="submit" value="Загрузить" />
									</form>
								<? endif; ?>
								<?= new View('widgets/common/error_widget') ?>
							<? endif; ?>
						</div>
					<? endif; ?></dt>						
				</dl>
			<!--/личная-->
			<!--места-->
			
			
				<div class="placeUser">
					<div class="listBlock">
					    <div class="block placeList">
						    <!---->
						    <?  
						    $fav_places_list=new View('widgets/poi/profile_places_widget', array('places'=>$fav_places, 'type'=>'favorite',
																							'places_count'=>$fav_places_count,'per_page'=>$fav_places_max));
							echo  $fav_places_list;
						    
						    ?>
					    </div>
						<!--/-->
						<!--Посещенные места-->
						<div class="block placeList">
						   <?						   
						   	$been_places_list=new View('widgets/poi/profile_places_widget', array('places'=>$been_places, 'type'=>'been',
																							'places_count'=>$been_places_count,'per_page'=>$been_places_max));
							echo  $been_places_list;
							?> 
						</div>
						<!--/-->
				    </div>
			    </div>
			<!--/места-->
			<!--друзья/фотки-->
				<div class="placeUser">
					<div class="listBlock">
						<!---->
							<div class="block">
								<?
									$friends=new View('widgets/user/profile_friends_widget', array('friends'=>$friends,
																							'friends_count'=>$friends_count,'per_page'=>$friends_max));
									echo  $friends;
								?>
							</div>
						<!--/-->
						<!---->
						<div class="block photoList">
							<?
									$photos=new View('widgets/photos/profile_photos_widget', array('photos'=>$photos,
																							'photo_count'=>$photo_count,'per_page'=>$photo_max));
									echo  $photos;
								?>
						</div>
						<!--/-->
				
					</div>
				</div>
			<!--/друзья/фотки-->
			</div>
		</div>
	</div>