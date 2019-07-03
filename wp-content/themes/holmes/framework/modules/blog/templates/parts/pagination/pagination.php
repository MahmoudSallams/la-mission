<?php
$pagination_type = holmes_mkdf_get_meta_field_intersect('blog_pagination_type');

if(!empty($pagination_type) && !empty($params)) {
	holmes_mkdf_get_module_template_part('templates/parts/pagination/'.$pagination_type, 'blog', '', $params);
}