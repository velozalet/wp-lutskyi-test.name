<?php get_header();?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="display-4 text-center"><?=get_the_title();?></h1>

            <?php if( has_post_thumbnail() ):?>
                <img class="card-img-top w-50 mb-2" src="<?=get_the_post_thumbnail_url();?>" alt="Card image cap">
            <?php endif;?>

            <?php if( have_posts() ): ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php the_content();?>
                <?php endwhile;?>
            <?php endif;?>

            <div class="category-car-info">
                <?php foreach( get_cat_name_by_custom_post_id() as $category_name ):?>
                    <ul>
                        <li> <strong><?=$category_name;?></strong> </li>
                    </ul>
                <?php endforeach;?>
            </div>

            <div class="car--info mt-4 mb-4">
                <h3 class="text-start">Cars Info:</h3>
                <?php if( $id_color_meta_box = get_post_meta($post->ID, 'id_color_meta_box', true) ):?>
                    <p class="car--info-item car--info-item--color">Color: <span style="background-color:<?=$id_color_meta_box;?>"></span> </p>
                <?php endif;?>

                <?php if( $id_select_meta_box = get_post_meta($post->ID, 'id_select_meta_box', true) ):?>
                    <p class="car--info-item car--info-item--fuel">Fuel type: <span><?=$id_select_meta_box;?></span> </p>
                <?php endif;?>

                <?php if( $id_power_meta_box = get_post_meta($post->ID, 'id_power_meta_box', true) ):?>
                    <p class="car--info-item car--info-item--power">Power car(HP): <span><?=$id_power_meta_box;?></span> </p>
                <?php endif;?>

                <?php if( $id_price_meta_box = get_post_meta($post->ID, 'id_price_meta_box', true) ):?>
                    <p class="car--info-item car--info-item--price">Price car($): <span><?=$id_price_meta_box;?></span> </p>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<?php get_footer();?>