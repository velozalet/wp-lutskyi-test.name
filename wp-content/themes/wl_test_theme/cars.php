<?php
/**
 * Template Name: Page Cars
*/
?>
<?php get_header();?>

<div class="container">
    <h1 class="display-4 text-center"><?=get_the_title();?></h1>
    <?php if( have_posts() ): ?>
        <?php while (have_posts()): the_post(); ?>
            <?php the_content();?>
        <?php endwhile;?>
    <?php endif;?>
 </div> <!--container-->

<div class="container-md mt-lg-5 mt-md-4 mt-3 mb-4">
    <div class="row">
        <?php
            $posts = get_posts( array(
                'numberposts' => -1,
                'category'    => 0,
                'category_name' => '',
                'orderby'     => 'date',
                'order'       => 'ASC',
                'include'     => array(),
                'exclude'     => array(),
                'meta_key'    => '',
                'meta_value'  =>'',
                'post_type'   => 'car',
                'suppress_filters' => false,
            ) );
        ?>
        <?php foreach( $posts as $post ): setup_postdata($post);?>
            <div class="col-lg-4 col-md-6 col-12 mt-4">
                <div class="card">
                    <?php if( has_post_thumbnail() ):?>
                        <img class="card-img-top" src="<?=get_the_post_thumbnail_url();?>" alt="Card image cap">
                    <?php endif;?>

                    <div class="card-body text-md-start text-center">
                        <h5 class="card-title text-capitalize">
                            <a href="<?=get_permalink();?>"><?=get_the_title();?></a>
                        </h5>
                        <p class="card-text"><?=get_the_excerpt();?></p>
                        <a href="<?=get_permalink();?>" class="btn btn-outline-warning btn-sm mx-auto text-uppercase">read more</a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>

<?php get_footer();?>