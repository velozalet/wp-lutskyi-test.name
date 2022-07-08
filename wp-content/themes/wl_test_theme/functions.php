<?php		
/**_____ACTIONS */
//Register and include style & scripts Theme
add_action('wp_enqueue_scripts', 'theme_add_styles_and_scripts');
function theme_add_styles_and_scripts() {
    //Styles:
    wp_enqueue_style('bootstrap5_scc', get_template_directory_uri().'/assets/bootstrap-5.1.3-dist/css/bootstrap.min.css', array());
    wp_enqueue_style('style', get_stylesheet_uri());

    //Scripts:
    wp_enqueue_script('popper_js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js', array(), '1.0', true);
    wp_enqueue_script('bootstrap5_js', get_template_directory_uri() .'/assets/bootstrap-5.1.3-dist/js/bootstrap.min.js', array(), '1.0', true);
}

//Register Menus Theme
add_action('after_setup_theme', 'theme_register_nav_menus');
function theme_register_nav_menus() {
    register_nav_menus( [
        'primary_menu' => 'Primary Menu',
        'footer_menu' => 'Footer Menu'
    ] );
}

//Add logo in Theme customize
add_action('after_setup_theme', 'themename_custom_logo_setup' );
function themename_custom_logo_setup() {
    $args = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => false, 
    );
    add_theme_support('custom-logo', $args );
}
//Add Thumbnails for Posts & Pages Theme
add_action( 'after_setup_theme', 'add_thumbnails_post_and_page' );
function add_thumbnails_post_and_page(){
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'post-thumbnails', array('post') );
    add_theme_support( 'post-thumbnails', array('page') );
    add_theme_support( 'post-thumbnails', array('car') ); //for custom type Post "Car"
}
//Add new Post formats
add_action( 'after_setup_theme', 'add_post_formats' );
function add_post_formats(){
    add_theme_support( 'post-formats', array('aside','gallery','image','status') );
}

//Add the Theme Customizer page to Admin menu --> (!)В последних версиях WP этот функциона больше не требуется. Настройщик автоматически добавляется в меню, даже если тема его не использует
function example_customizer_menu() {
    add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
}
add_action( 'admin_menu', 'example_customizer_menu' );
//Add individual sections,settings,and controls to the theme customizer
add_action( 'customize_register', 'example_customizer' );
function example_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'example_section_one',
        array(
            'title' => 'Telephone Number',
            'description' => 'This is settings section with telephone',
            'priority' => 35,
        )
    );
    $wp_customize->add_setting(
        'telephone',
        array(
            'default' => '33 14 29',
        )
    );
    $wp_customize->add_control(
        'telephone',
        array(
            'label' => 'Telephone:',
            'section' => 'example_section_one',
            'type' => 'tel',
        )
    );
}


//Add custom Post type 'Car'
add_action('init', 'post_type_car');
function post_type_car(){
    $labels_tax = array(
        'name'                       => _x( 'Car categories', 'car' ),
        'singular_name'              => _x( 'Car category', 'car' ),
        'menu_name'                  => __('Car categories'),
        'all_items'                  => __( 'All Cars', 'car' ),
        'parent_item'                => __( 'Parent category', 'car' ),
        'parent_item_colon'          => __( 'Parent category:', 'car' ),
        'new_item_name'              => __( 'New Category', 'car' ),
        'add_new_item'               => __( 'Add New Category', 'car' ),
        'edit_item'                  => __( 'Edit Category', 'car' ),
        'update_item'                => __( 'Update Category', 'car' ),
        'search_items'               => __( 'Search Category', 'car' ),
        'add_or_remove_items'        => __( 'Add or Delete Category', 'car' ),
        'choose_from_most_used'      => __( 'Choose from most used', 'car' ),
        'not_found'                  => __( 'Not find Category', 'car' ),
        'separate_items_with_commas' => __('Separate/'),
    );
    $args_tax = array(
        'labels'                     => $labels_tax,
        'description'                => 'Some description this Categories...',
        'hierarchical'               => false,
        'public'                     => true,
        'publicly_queryable'         => null,
        'show_in_nav_menus'          => true,
        'show_ui'                    => true,
        'show_tagcloud'              => true,
        'update_count_callback'      => '', 
        'query_var'                  => true,
        'rewrite'                    => array('slug' => 'car-category'),
        'capabilities'               => array(),
        'meta_box_cb'                => null,
        'show_admin_column'          => true,
        'sort'                       => null,
        'show_in_quick_edit'         => null,
        '_builtin'                   => false,
    );

    $labels = array(
        'name'               => 'Cars',
        'singular_name'      => 'Car',
        'add_new'            => 'Add new',
        'add_new_item'       => 'Add new Car',
        'edit_item'          => 'Edit Car',
        'new_item'           => 'New Car',
        'view_item'          => 'View Car',
        'search_items'       => 'Search Car',
        'not_found'          => 'Not found Car',
        'not_found_in_trash' => 'Not found Car in trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Car'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-car', 
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'supports' => array('title','editor','author','thumbnail','excerpt','post-formats','page-attributes','revisions'),
        'taxonomies' => array('car_taxonomy')
    );

    register_taxonomy('car_taxonomy', array('car'), $args_tax);
    register_post_type('car', $args);
}

/** Add "meta box" to custom Post type 'Car'*/
add_action('add_meta_boxes', 'add_car_posts_meta_box');
function add_car_posts_meta_box() {
    add_meta_box(
        'add_car_posts_meta_box_id', 
        'Meta-Box fields:',
        'show_car_posts_meta_box',
        'car',
        'normal',
        'high'
    );
}
/** Set "meta field" for "meta box" in Admin-Panel */
$meta_fields_for_meta_box = array(
    array(
        'label' => 'Color:',
        'desc'  => 'Color for Car',
        'id'    => 'id_color_meta_box',
        'type'  => 'color'
    ),
    array(
        'label' => 'Fuel list',
        'desc'  => 'Select fuel for Car',
        'id'    => 'id_select_meta_box',
        'type'  => 'select',
        'options' => array (
            'one' => array (
                'label' => 'Petrol',
                'value' => 'petrol'
            ),
            'two' => array (
                'label' => 'Diesel',
                'value' => 'diesel'
            ),
            'three' => array (
                'label' => 'Ethanol',
                'value' => 'ethanol'
            )
        )
    ),
    array(
        'label' => 'Power:',
        'desc'  => 'Power for Car',
        'id'    => 'id_power_meta_box',
        'type'  => 'number'
    ),
    array(
        'label' => 'Price:',
        'desc'  => 'Price for Car',
        'id'    => 'id_price_meta_box',
        'type'  => 'number'
    )
);
/*Show meta-fields*/
function show_car_posts_meta_box() {
    global $meta_fields_for_meta_box;
    global $post;
    echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

    echo '<table class="form-table">';

    foreach ($meta_fields_for_meta_box as $field) {  //var_dump($meta_fields_countries_meta_box);die;
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
              <td>';

        switch($field['type']):
            case 'color':
                echo '<input type="color" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />
                      <br /><span class="description">'.$field['desc'].'</span>';
                break;

            case 'number':
                echo '<input type="number" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />
                        <br /><span class="description">'.$field['desc'].'</span>';
                break;

            case 'select':
                echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
                }
                echo '</select><br /><span class="description">'.$field['desc'].'</span>';
                break;
        endswitch;
        echo '</td></tr>';
    }
    echo '</table>';
}
/** Save "meta fields" from Admin-Panel in DB */
add_action('save_post', 'save_fields_of_car_posts_meta_box');
function save_fields_of_car_posts_meta_box($post_id) {
    global $meta_fields_for_meta_box;

    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) { return $post_id; }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) { return $post_id; }
    }
    elseif (!current_user_can('edit_post', $post_id)) { return $post_id; }

    foreach ($meta_fields_for_meta_box as $field):
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        }
        elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    endforeach;
}
/**__________________________________________________________________________/ACTIONS */

/** SHORTCODES */
add_shortcode('get_cars_limit10_sc','get_cars_limit10_func' );
    function get_cars_limit10_func(){
        $recent_posts = wp_get_recent_posts(array('post_type'=>'car'));
        foreach( $recent_posts as $recent ){
            $res .= '<li><a href="'.get_permalink($recent["ID"]).'"title="Look'.esc_attr($recent["post_title"]).'" >'. $recent["post_title"].'</a> </li>';
        }
        return $res;
}


/** CUSTOM FUNCTIONS */
function get_cat_name_by_custom_post_id(){ //$post->ID OR get_the_ID() for getting current Post ID
    global $wpdb;
    //global $post;
    $result_query = $wpdb->get_results(" select term_taxonomy_id from " .$wpdb->prefix. "term_relationships where object_id = '" .get_the_ID(). "' ");
    $cats_ids_array = []; //array for ids for current custom Post Type
    foreach($result_query as $cat_id){
        $cats_ids_array[] = get_term( $term_id = $cat_id->term_taxonomy_id );
    }
    $cats_names_array = []; //array for names of categories(taxonomies) for current custom Post Type
    foreach ($cats_ids_array as $cat_info) {
        $cats_names_array[] = $cat_info->name;
    }
    return $cats_names_array;
}

?>