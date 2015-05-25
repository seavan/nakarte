<li>
<div class="name">
<a href="/u<?=$item->user->id?>">
<img src="<?=$item->user->avatar_url('sm')?>" alt="" />
<?= $item->user->firstname ?>
</a>
<?= $item->atime ?>
</div>
<?= $item->text ?>
</li>
