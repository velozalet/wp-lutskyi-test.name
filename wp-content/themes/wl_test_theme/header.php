<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cars catalog">

    <?php wp_head();?>
</head>

<body <?php body_class($class);?>>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
        <div class="container-fluid">

            <div class="pe-3">
                <?=get_custom_logo();?> 
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                $args = [
                    'theme_location'  => 'primary_menu',
                    'menu'            => 'Primary',
                    'container'       => false,
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '', 
                    'after'           => '', 
                    'link_before'     => '', 
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => '',
                ];
                wp_nav_menu($args);
                ?>
            </div>
            <p style="color:white;"><?=get_theme_mod('telephone','no telephone number');?></p>
            
        </div>
    </nav>
