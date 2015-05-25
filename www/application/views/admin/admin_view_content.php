<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>


<div class="admin_content">
    <div class="admin_toolbar">
    	<div class="admin_icon"><a href="/"><img src="/static/images/nakarte.png" alt="Главная"/><span>На Карте</span></a></div>
        <div class="admin_icon"><a href="/admin/list_objects"><img src="/static/images/object_list.png" alt="Список объектов"/><span>Список объектов</span></a></div>
        <div class="admin_icon"><a href="/admin/rubric"><img src="/static/images/rubric_tree.png" alt="Список объектов"/><span>Дерево рубрик</span></a></div>
        <div class="admin_icon"><a href="/admin/edit_attribute_types"><img src="/static/images/attribute_list.png" alt="Список объектов"/><span>Типы атрибутов</span></a></div>
        <div class="admin_icon"><a href="/admin/select_rubric"><img src="/static/images/rubrics.png" alt="Список объектов"/><span>Атрибуты рубрик</span></a></div>
        <div class="admin_icon"><a href="/admin/create_object"><img src="/static/images/create_object.png" alt="Список объектов"/><span>Создать объект</span></a></div>
        <div class="admin_icon"><a href="/admin/photos"><img src="/static/images/picture.png" alt="Фотографии"/><span>Фотографии</span></a></div>
        <div class="admin_icon"><a href="/admin/users"><img src="/static/images/user.png" alt="Пользователи"/><span>Пользователи</span></a></div>
        <div class="admin_icon"><a href="/admin/cities"><img src="/static/images/city.png" alt="Города"/><span>Города</span></a></div>
        <div class="admin_icon"><a href="/admin/photos"><img src="/static/images/email.png" alt="Рассылки"/><span>Рассылки</span></a></div>
    </div>
    <div style="clear: both">
        <?php echo $content; ?>
    </div>
</div>
