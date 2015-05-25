<?php
class NakarteHtml
{
	public static function CommentItem($comment)
	{
		echo "<li>";
		echo '<div class="name">';
		echo '<a href="#">';
		echo '<img src="/static/images/pic1.jpg" alt="" />';
		echo $comment->user->firstname;
		echo '</a>';
		echo $comment->atime;
		echo '</div>';
		echo $comment->text;
		echo '</li>';
	}

	public static function PlaceItem($place)
	{
		echo "<li class='icScool'>";
		echo "<a href='poi/$place->id' class='name'>$place->caption</a>";
		echo $place->getKzFreeAddress();
		echo "<br/>";
		echo "<span>Рубрика:</span> ";
		foreach($place->rubrics as $rubric)
		{
			echo "<a href='#'>$rubric->name</a>&nbsp;";
		}
		if( $place->user_id )
		{
			echo "<br/>";
			echo "<span>Добавил:</span>";
			echo "<a href='#' class='user'>";
			echo $place->user->firstname;
			echo "</a>";
		}
		else
		{
			echo "<br/>";
			echo "<span>Добавила:</span>&nbsp;";
			echo "<a href='http://www.notamedia.ru/' class='user'>";
			echo "Notamedia.ru";
			echo "</a>";
		}
		echo "</li>";
	}

	public static function PopularPlaceItem($place)
	{
		echo "<li class='icScool'>";
		echo "<a href='poi/$place->id' class='name'>$place->caption</a>";
		echo $place->getKzFreeAddress();
		echo "<br/>";
//		echo "Андалузская ул., д.15, стр.2<br>";
//		echo "<span>Рубрика:</span> ";
//		foreach($place->rubrics as $rubric)
//		{
//			echo "<a href='#'>$rubric->name</a>&nbsp;";
//		}
//		echo "<br/>";
//		echo "<span>Добавила:</span> <a href='#' class='user'>Богатоз Кашкамбаева</a>";
		echo "</li>";
	}

	public static function InnerPlaceItem($place)
	{
		echo "<dl class='block'>\n";
		echo 	"<dt><a href='/poi/$place->id'>$place->caption</a></dt>\n";
		echo 	"<dd>\n";
		echo	 	"<div class='num'>$place->id.</div>\n";
		echo		"<div class='general_cont'>\n";
		echo			"<div class='rating'>\n";
		echo				"<div><span style='width:50%'>&nbsp;</span></div>\n";
		echo				"<span class='value'>$place->rating</span>\n";
		echo			"</div>\n";
		echo			"<a href='#' class='comment'>" . count($place->poi_comments) . "</a>\n";
		echo		"</div>\n";
		echo		$place->getKzFreeAddress()."<br />\n";
		foreach($place->rubrics as $rubric)
		{
			echo "<span>Рубрика:</span> <a href='#'>$rubric->name</a><br />\n";
		}
		if( $place->user_id )
		{	
			echo "<span>Добавил:</span> <a href='#' class='user'>$place->user->firstname</a>\n";	
		}
		else
		{
			echo "<span>Добавила:</span>";
			echo "<a href='http://www.notamedia.ru/' class='user'>";
			echo "Notamedia.ru";
			echo "</a>";
		}		
		echo	"</dd>\n";
		echo "</dl>\n";
	}
	
	public static function InnerPhotoItem($photo)
	{
		$conf = Kohana::config('photos');
		echo "<div class='block'>";
		echo 	"<a href='/photos/id/" . $photo->guid . "' class='f'><span><img src='". $conf['photo_path']. $photo->guid . ".thumb.jpg' alt='' /></span></a>\n";
		echo 	$photo->poi->caption . ", " . $photo->poi->address . "<br />\n";
		echo	"<span>Рубрика:</span> <a href='#'>". $photo->poi->rubrics[0]->name ."</a><br />\n";
		echo 	"<span>Добавил:</span> <a href='#' class='user'>". $photo->user->firstname ."</a>\n";
		echo "</div>";
	}

	public static function InnerUser($place)
	{
	}

	public static function OuterUser($user)
	{
		echo "<li>";
		echo '<a href="/u'.$user->id.'">';
		echo '<img src="'.$user->avatar_url('sm').'" alt="" />';
		echo $user->getFullName();
		echo "</a>";
		//echo "Андалузская ул., д.15, стр.2";
		echo "</li>";
	}

	public static function AttributeValueItem($attribute)
	{
		echo "<li>";
		echo "<span>" . $attribute->attribute_type->caption . ":</span>";
		echo "<div>$attribute->value</div>";
		echo "</li>";
	}

	public static function RubricWidgetParentItem($rubric)
	{
		echo "<li class='$rubric->class' rel='$rubric->id'>";
		echo "<a href='#'  rel='$rubric->id'>";
		echo $rubric->name;
		echo "</a>";
		echo '</li>';
	}

	public static function FormatOrm($orm, $function)
	{
		foreach($orm as $item) self::$function($item);
	}
	
	public static function FormatOrmView($orm, $view_path, $params = array())
	{
		$i = 0;
		$count = count($orm);
		foreach($orm as $item)
		{
			$view = new View($view_path, $params);
			$view->index = $i; 
			$view->item = $item;
			$view->count = $count;
			$index = $i;
		 	echo $view;
		 	++$i;
		}
	}
}
