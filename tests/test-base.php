<?php
/**
 * WooCommerce_Category_Sorting.
 *
 * @since   0.0.0
 * @package WooCommerce_Category_Sorting
 */
class WooCommerce_Category_Sorting_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'WooCommerce_Category_Sorting') );
	}

	/**
	 * Test that our main helper function is an instance of our class.
	 *
	 * @since  0.0.0
	 */
	function test_get_instance() {
		$this->assertInstanceOf(  'WooCommerce_Category_Sorting', woocommerce_category_sorting() );
	}

	/**
	 * Replace this with some actual testing code.
	 *
	 * @since  0.0.0
	 */
	function test_sample() {
		$this->assertTrue( true );
	}
}
