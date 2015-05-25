<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="admin_content" >

    <table cellspacing="20" style="font-size: 14pt">
        <tr>
            <?php
            $cities = ORM::factory('city')->find_all();
            $columnCount = 5;
            $rowsPerColumn = count($cities) / $columnCount;
            $lastchar = '';
            echo "<td>";
            $i = -1;
            foreach($cities as $city) {
                if($i++ > $rowsPerColumn) {
                    $i = 0;
                    echo "</td><td>";
                }

                $curchar = mb_substr($city->name, 0, 1);
                if( $curchar != $lastchar ) {
                    $lastchar = $curchar;
                    if($i > 0) echo "<br/>";
                    echo "<div class='alpha_head'>$lastchar</div>";
                }
                echo "<a href='/admin/rubric/$city->id'>$city->name</a><br/>";
            }
            echo "</td>";
            ?>
        </tr>
    </table>
</div>