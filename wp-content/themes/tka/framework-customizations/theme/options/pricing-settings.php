<?php

if (!defined('FW')) {
    die('Forbidden');
}
$options = array (
    'pricing-tab' => array (
        'title'   => esc_html__('Pricing settings') ,
        'type'    => 'tab' ,
        'options' => array (
            'pricing-box' => array (
                'title'   => esc_html__('Pricings') ,
                'type'    => 'box' ,
                'options' => array (
                    'pricings' => array(
                        'label'         => 'Pricing Tables',
                        'popup-title'   => __( 'Add/Edit pricing' ),
                        'desc'          => '',
                        'type'          => 'addable-box',
                        'width'         => 'full',
                        'template'      => '{{=header}}',
                        'box-options' => array(
                            'header'   => array(
                                'label' => __( 'Header' ),
                                'desc'  => __( 'Enter the Header of the pricing' ),
                                'type'  => 'text'
                            ),
                            'body' => array(
                                'label' => __( 'Body' ),
                                'desc'  => __( 'Content' ),
                                'type'  => 'wp-editor',
                                //'editor_type' => 'html',
                                'size' => 'large',
                            ),
                            'url'   => array(
                                'label' => __( 'Url' ),
                                'desc'  => __( 'View more url' ),
                                'type'  => 'text',
                            ),
                        ),
                        'sortable' => true,
                    ),
                ),
            ) ,
        ),
    ),
);


/*
a:10:{s:7:"hotline";s:0:"";s:14:"text-copyright";s:0:"";s:6:"slider";s:1:"1";s:11:"404_heading";s:3:"404";s:16:"archives_heading";s:10:"Danh sách";s:14:"search_heading";s:11:"Tìm kiếm";s:12:"subheader_bg";s:0:"";s:13:"subheader_txt";s:0:"";s:18:"subheader_bg_image";s:0:"";s:7:"pricings";a:1:{i:0;a:4:{s:6:"header";s:18:"Trọn gói đ/m²";s:4:"body";s:575:"<h2 style="text-align: center;"><span style="color: #ed6f2a;"><strong>249,000</strong></span></h2><p style="text-align: center;">Nhà phố, Biệt thự Khách sạn, Resort</p><h3 style="text-align: center;"><span style="color: #ed6f2a;"><strong>299,000</strong></span></h3><p style="text-align: center;">Bar, Cafe, Nhà hàng Nhà nhỏ dưới 120m² Nhà phong cách cổ điển</p><h3 style="text-align: center;"><span style="color: #ed6f2a;"><strong>199,000</strong></span></h3><p style="text-align: center;">Sân vườn, Cảnh quan Tư vấn thiết kế nhanh</p>";s:6:"footer";s:249:"<p style="text-align: center;">Bảng vẽ Kiến trúc,</p><p style="text-align: center;">Nội thất Kết cấu,</p><p style="text-align: center;">M&amp;E Hồ sơ xin phép xây dựng</p><p style="text-align: center;">Giám sát tác giả</p>";s:4:"sale";b:0;}}}
 */