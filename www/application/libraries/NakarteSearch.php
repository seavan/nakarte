<?php


class NakarteSearch
{
	public static function formatNormalWhere($_what)
	{
		$likes = array();
		$_fields = array("rubric_name", "parent_rubric_name", "caption", "key_value", "descr");

		// only one keyword
		$what = $_what;
		$fields = $_fields;
		for($i = 0; $i < count($fields); $i++) $fields[$i] =  $fields[$i] . " LIKE '%" . $what . "%'";
		$likes[] = "(" . implode(" OR ", $fields) . ")";
		$like = implode(" AND ", $likes);
		return $like;
	}

	public static function formatAttWhere($_what)
	{
		// find all attributes which have this alias
		$att_query = ORM::factory('attribute_type_substitution')->where('alias', $_what);

		$vals = array();
		if($att_query->count_all() > 0)
		{
			$attAlias = $att_query->find_all();
			foreach($attAlias as $alias)
			{
				$vals[$alias->attribute_type_id] = $alias->code;
			}
		}

		if(count($vals) > 0)
		{
			foreach($vals as $key => $val)
			{
				$fields[] = " ((key_id = $key) AND (key_code & $val > 0)) ";
			}

			$res = implode(" OR ", $fields);
			return $res;
		}
		else
		{
			return null;
		}
	}

	public static function formatUnitedWhere($_what)
	{
		$attWhere = self::formatAttWhere($_what);
		if($attWhere)
			return "($attWhere)";
		else
			return "(" . self::formatNormalWhere($_what) . ")";
	}

	public static function formatUnitedSelect($_what)
	{
		$_what = mysql_real_escape_string($_what);
		$query = "SELECT '$_what', poi_search.id, poi_search.city_id, poi_search.lat, poi_search.lon FROM poi_search WHERE ".
				self::formatUnitedWhere($_what);
		return $query;
		//echo $query;
	}

	public static function search($tl, $tr, $bl, $br, $city, $_what)
	{
//		self::clear_cache();

		return self::cache_search($_what, 8, 0, 0, 0, 0);
	}

	public static function search_rubrics($tl, $tr, $bl, $br, $city, $rubrics)
	{
//		self::clear_cache();
		$set = implode(',', $rubrics);
		$query = "SELECT pois.*, IFNULL(rubrics.class, 'rCafe_Other') as rubric_class  FROM pois_rubrics LEFT JOIN pois ON pois_rubrics.poi_id = pois.id INNER JOIN rubrics ON pois_rubrics.rubric_id = rubrics.id WHERE pois_rubrics.rubric_id IN ($set) AND pois.city_id = $city";
		$db = Database::instance();
		return $db->query($query);
		
	}

	

	public static function cache_search($keyword_query, $city_id, $tl, $tr, $bl, $br)
	{
		if( strlen($keyword_query) == 0 ) return new stdClass();
		
		$db = Database::instance();


		$keyword_query = addslashes($keyword_query);
		$keywords = explode(" ", $keyword_query);

		// get the queries in the lowest order
		// TODO: optimize when keyword count == 0
		$cachewords = array();
		foreach($keywords as $keyword)
		{
			// check if we actually have the word in the cache
			if( $db->where('text', $keyword)->count_records('cache_hits') == 0 )
			{
				self::cache_keyword($keyword);
			}

			$cachewords[] = " text = '$keyword' ";
		}


		$cachepositions = $db->query("SELECT * FROM cache_hits WHERE " . implode(" OR ", $cachewords) . " ORDER BY cache_count ASC");
		$cachejoins = array();
		
		$i = 0;
		$lastIndex = count($cachepositions) - 1;
		$joinquery = "SELECT pois.*, IFNULL(rubrics.class, 'rCafe_Other') as rubric_class FROM search_cache sc$i ";
		$joinwhere = " LEFT JOIN pois ON pois.id = sc$lastIndex.poi_id WHERE sc$i.city_id = $city_id AND sc$i.text = '" . $cachepositions[0]->text . "'";

		for($i = 1; $i <= $lastIndex; ++$i)
		{
			$n = $i - 1;
			$text = $cachepositions[$i]->text;
			$joinquery .= " INNER JOIN search_cache sc$i ON sc$i.poi_id = sc$n.poi_id AND sc$i.text = '$text' ";
		}

		$joinquery .= " INNER JOIN pois_rubrics ON pois_rubrics.poi_id = sc0.poi_id INNER JOIN rubrics ON pois_rubrics.rubric_id = rubrics.id ";
		$joinquery .= $joinwhere;
		//echo $joinquery;
		return $db->query($joinquery);
	}

	public static function cache_keyword($keyword)
	{
		$db = Database::instance();
		$db->delete('cache_hits', array('text' => $keyword));
		$db->delete('search_cache', array('text' => $keyword));
		$query = 'INSERT INTO search_cache(text, poi_id, city_id, lat, lon) ' . self::formatUnitedSelect($keyword) . " GROUP BY poi_search.id";
		
		$db->query($query);
		$db->insert('cache_hits', array('text' => $keyword, 'cache_count' => mysql_affected_rows()));
	}

	public static function clear_cache()
	{
		$db = Database::instance();
		$db->where('1')->delete('cache_hits');
		$db->where('1')->delete('search_cache');

	}
}

?>
