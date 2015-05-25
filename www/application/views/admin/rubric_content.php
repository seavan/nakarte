<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="rubrics">
<div>
    <?php print $this->userinfo; ?>
</div>
<p>
    <?php print html::anchor("admin/select_city", 'Панель управления'); ?>
</p>
    <table>
        <tr>
            <?php

            $rubricCount = count($this->rubrics);
            $columnCount = 3;
            $rubricPerColumn = $rubricCount / $columnCount;

            echo "<td>";
            $i = 1;
            foreach ($this->rubrics as $rubric) {
                echo "<div class='rubric'>";
                echo "<div class='rubric_header'>" . html::anchor("map/rubric/" . $rubric->id, $rubric->name) . "</div>";
                foreach($rubric->rubrics as $subItem) {
                    echo "<div class='rubric_item'>" . html::anchor("map/rubric/" . $subItem->id, $subItem->name) . "</div>";
                }
                echo "</div>";
                if($i >= $rubricPerColumn) {
                    $i = 0;
                    echo "</td><td>";
                }
                ++$i;
            }

            echo "</td>";
            ?>
        </tr>
    </table>
</div>
<br class="clear"/>