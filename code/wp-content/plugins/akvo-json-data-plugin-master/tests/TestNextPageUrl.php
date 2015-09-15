<?php

namespace Test;

use DataFeed\Pagination\PageUrl;
use DataFeed\Pagination\NextPageUrl;
use DataFeed\Pagination\PageUrlFailureException;
use DataFeed\ObjectQuery\SimpleObjectQueryLanguage;

class TestNextPageUrl extends \PHPUnit_Framework_TestCase
{

	private function mockQueryLanguage() {
		$ql = $this->getMockBuilder('DataFeed\ObjectQuery\ObjectQueryLanguage')->setMethods( array( 'query' ) )->getMock();

		$ql->expects( $this->any() )
			->method( 'query' )
			->will( $this->returnCallback( function( $expr, $item ) {
						if (is_object($item)) {
							if (isset($item->next)) {
								return $item->next;
							}
							return null;
						} else {
							if (isset($item['next'])) {
								return $item['next'];
							}
							return null;
						}
					} ) );

		return $ql;
	}

	public function test()
	{

		$pu = new NextPageUrl( $this->mockQueryLanguage() );

		$item = array(
			array( 'next' => 'http://1' ),
			array( 'next' => 'http://2' ),
			array()
		);

		$meta = array();

		$this->assertTrue($pu->pageUrl( $meta, 'http://0', null, 0 ));

		$this->assertEquals( array( 'http://0' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[0], 1 ));

		$this->assertEquals( array( 'http://0', 'http://1' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[1], 2 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[2], 3 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );


		// New run no updates

		$this->assertFalse($pu->pageUrl( $meta, 'http://0', $item[0], 0 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[0], 1 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[1], 2 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[2], 3 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		// New run with added item.

		$item = array(
			array( 'next' => 'http://1' ),
			array( 'next' => 'http://2' ),
			array( 'next' => 'http://3' ),
			array()
		);

		$this->assertFalse($pu->pageUrl( $meta, 'http://0', $item[0], 0 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[0], 1 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[1], 2 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[2], 3 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2', 'http://3' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		// New run removed items

		$item = array(
			array( 'next' => 'http://1' ),
			array( 'next' => 'http://2' ),
			array()
		);

		$this->assertFalse($pu->pageUrl( $meta, '', $item[1], 2 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2', 'http://3' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[2], 3 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2', ), $meta[PageUrl::PAGE_URL_ARRAY] );

		// Updated item

		$item = array(
			array( 'next' => 'http://2' ),
			array( 'next' => 'http://3' ),
			array()
		);

		$this->assertTrue($pu->pageUrl( $meta, 'http://1', null, 0 ));

		$this->assertEquals( array( 'http://1', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[0], 1 ));

		$this->assertEquals( array( 'http://1', 'http://2', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[1], 2 ));

		$this->assertEquals( array( 'http://1', 'http://2', 'http://3' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[2], 3 ));
	}

	public function testObject()
	{

		$pu = new NextPageUrl( $this->mockQueryLanguage() );

		$item1 = new \stdClass();
		$item2 = new \stdClass();
		$item3 = new \stdClass();
		$itemnull = new \stdClass();
		$item1->next = 'http://1';
		$item2->next = 'http://2';
		$item3->next = 'http://3';
		
		$item = array( $item1, $item2, $itemnull );

		$meta = array();

		$this->assertTrue($pu->pageUrl( $meta, 'http://0', null, 0 ));

		$this->assertEquals( array( 'http://0' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[0], 1 ));

		$this->assertEquals( array( 'http://0', 'http://1' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[1], 2 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[2], 3 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );


		// New run no updates

		$this->assertFalse($pu->pageUrl( $meta, 'http://0', $item[0], 0 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[0], 1 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[1], 2 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[2], 3 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		// New run with added item.

		$item = array( $item1, $item2, $item3, $itemnull );

		$this->assertFalse($pu->pageUrl( $meta, 'http://0', $item[0], 0 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[0], 1 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[1], 2 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[2], 3 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2', 'http://3' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		// New run removed items

		$item = array( $item1, $item2, $itemnull );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[1], 2 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2', 'http://3' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[2], 3 ));

		$this->assertEquals( array( 'http://0', 'http://1', 'http://2', ), $meta[PageUrl::PAGE_URL_ARRAY] );

		// Updated item

		$item = array( $item2, $item3, $itemnull );

		$this->assertTrue($pu->pageUrl( $meta, 'http://1', null, 0 ));

		$this->assertEquals( array( 'http://1', 'http://1', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[0], 1 ));

		$this->assertEquals( array( 'http://1', 'http://2', 'http://2' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertTrue($pu->pageUrl( $meta, '', $item[1], 2 ));

		$this->assertEquals( array( 'http://1', 'http://2', 'http://3' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', $item[2], 3 ));

		// Run with previous page null

		$this->assertFalse($pu->pageUrl( $meta, 'http://1', null, 0 ));

		$this->assertEquals( array( 'http://1', 'http://2', 'http://3' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', null, 1 ));

		$this->assertEquals( array( 'http://1', 'http://2', 'http://3' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		$this->assertFalse($pu->pageUrl( $meta, '', null, 2 ));

		$this->assertEquals( array( 'http://1', 'http://2', 'http://3' ), $meta[PageUrl::PAGE_URL_ARRAY] );

		try {
			$pu->pageUrl( $meta, '', null, 3 );
			$this->assertTrue(false, 'Expected Exception not thrown!');
		} catch (PageUrlFailureException $e) {
		}

		try {
			$pu->pageUrl( $meta, '', $item1, 2);
			$this->assertTrue(false, 'Expected loop detection exception not thrown!');
		} catch (PageUrlFailureException $e) {
		}

	}

	public function testRelativeUrl()  {

		$pu = new NextPageUrl( $this->mockQueryLanguage() );

		$meta = array();

		$this->assertTrue($pu->pageUrl( $meta, 'http://foo',  null, 0 ));

		$this->assertTrue($pu->pageUrl( $meta, 'http://foo', array( 'next' => '/bar' ), 1 ));

		$this->assertEquals( array( 'http://foo', 'http://foo/bar' ), $meta[PageUrl::PAGE_URL_ARRAY] );
	}

	public function testNextFieldPath() {

		$pu = new NextPageUrl( new SimpleObjectQueryLanguage(), 'foo->next' );

		$meta = array();

		$this->assertTrue($pu->pageUrl( $meta, 'http://foo',  null, 0 ));

		$this->assertTrue($pu->pageUrl( $meta, 'http://foo', array( 'foo' => array( 'next' => 'http://bar' ) ), 1 ));

		$this->assertEquals( array( 'http://foo', 'http://bar' ), $meta[PageUrl::PAGE_URL_ARRAY] );
		
	}
}
