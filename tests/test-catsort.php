<?php
/**
 * WooCommerce Category Sorting Catsort Tests.
 *
 * @since   0.0.0
 * @package WooCommerce_Category_Sorting
 */
class WCCS_Catsort_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'WCCS_Catsort' ) );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  0.0.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( 'WCCS_Catsort', woocommerce_category_sorting()->catsort );
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
