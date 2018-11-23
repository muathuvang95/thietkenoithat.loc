<?php

add_filter( 'fw_ext_projects_post_type_name', 'projects_post_type_name', 10, 1 );

add_action( 'wp_head', 'tka_header_styles', 15 );