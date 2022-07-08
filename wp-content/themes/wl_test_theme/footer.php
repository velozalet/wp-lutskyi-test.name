    <footer id="footer" class="bg-dark text-white">
        <div class="container-md pt-md-5 pt-4">

            <div class="row">
                <div class="col-lg-4 col-12">
                <h3 class="text-warning fst-italic">Header in footer block</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborum.</p>
                </div> <!--.col-* -->
                <div class="col-lg-4 col-md-6 col-12">
                <h3 class="text-warning fst-italic">Contacts</h3>
                <address class="fst-italic">
                    <b>Evergreen 746 | 1355 Market</b> <br/>
                    SanFrancisco, CA 94103<br/>
                    <?=get_theme_mod('telephone','no telephone number');?>
                </address>
                </div> <!--.col-* -->
                <div class="col-lg-4 col-md-6 col-12">
                    <h3 class="text-warning fst-italic">Navigation</h3>
                    <?php
                    $args = [
                        'theme_location'  => 'footer_menu',
                        'menu'            => 'Footer', 
                        'container'       => false, 
                        'container_class' => '', 
                        'container_id'    => '', 
                        'menu_class'      => 'navbar-nav list-unstyled font-monospace lh-1', 
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
                </div> <!--.col-* -->
            </div> <!--/.row-->
            <hr class="d-sm-block d-none">
            <div class="row">
                <div class="col-12 text-center mt-sm-0 mt-4">
                    <?=get_custom_logo();?>
                    <div class="text-muted fst-italic"> &copy; 2022 &nbsp; Lorem ipsum dolor sit amet. </div>
                </div>
            </div>

        </div> <!--/.container-->
    </footer>

<?php wp_footer();?>
</body>
</html>