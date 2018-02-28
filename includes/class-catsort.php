<?php
/**
 * WooCommerce Category Sorting Catsort.
 *
 * @since   0.0.0
 * @package WooCommerce_Category_Sorting
 */

/**
 * WooCommerce Category Sorting Catsort.
 *
 * @since 0.0.0
 */
class WCCS_Catsort {
	/**
	 * Parent plugin class.
	 *
	 * @since 0.0.0
	 *
	 * @var   WooCommerce_Category_Sorting
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  0.0.0
	 *
	 * @param  WooCommerce_Category_Sorting $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  0.0.0
	 */
	public function hooks() {
        add_action('product_cat_add_form_fields', [$this, 'add_meta_fields'], 11);
        add_action('product_cat_edit_form_fields', [$this, 'edit_meta_fields'], 11, 2);
        add_action('created_product_cat', [$this, 'save_meta']);
        add_action('edited_product_cat', [$this, 'save_meta']);
        add_filter('woocommerce_default_catalog_orderby', [$this, 'orderby_filter']);
	}

	public function orderby_filter($orderby){

	    if(is_product_category()){

$cat = get_queried_object();
	        if($cat){

                if(!is_wp_error($cat) && is_object($cat)){
                    $sort_order = get_term_meta( $cat->term_id,'cat_order', true);

                    if(!empty($sort_order)){
                        $orderby = $sort_order;
                    }elseif($cat->parent>0){
                        $parent_cat = get_term($cat->parent, 'product_cat');
                        $sort_order = get_term_meta( $parent_cat->term_id,'cat_order', true);
                        if(!empty($sort_order)) {
                            $orderby = $sort_order;
                        }
                    }
                }

            }




        }

	return $orderby;
    }

	public function add_meta_fields($taxonomy){
        return $this->meta_fields($taxonomy);
	}

	private function meta_fields($taxonomy, $term = null){

	    $cat_order = null;
	    if($term != null && is_object($term)){

	        $cat_order = get_term_meta($term->term_id, 'cat_order', true);
        }

        $sort_options = apply_filters( 'woocommerce_default_catalog_orderby_options', array(
            'menu_order' => __( 'Default sorting (custom ordering + name)', 'woocommerce' ),
            'popularity' => __( 'Popularity (sales)', 'woocommerce' ),
            'rating'     => __( 'Average rating', 'woocommerce' ),
            'date'       => __( 'Sort by most recent', 'woocommerce' ),
            'price'      => __( 'Sort by price (asc)', 'woocommerce' ),
            'price-desc' => __( 'Sort by price (desc)', 'woocommerce' ),
        ) );

	    ?>
        <tr class="form-field">
        <th scope="row" valign="top"><label for="cat_order">
            <?php _e('Category Sort Order', '') ?>
            </label></th><td>
        <select name="cat_order" class="postform" id="cat_order">
            <option value="">Default</option>
            <?php    foreach($sort_options as $key=>$option):    ?>
                <option value="<?= $key ?>" <?= $key==$cat_order?'selected':'' ?> > <?= $option ?></option>

            <?php endforeach ?>
        </select></td>
    </tr>

<?php


    }

    public function save_meta($term_id){
	    if(isset($_POST['cat_order'])){
	        update_term_meta($term_id, 'cat_order', esc_attr($_POST['cat_order']));
        }
    }

	public function edit_meta_fields($term, $taxonomy){

	    return $this->meta_fields($taxonomy, $term);
    }
}
