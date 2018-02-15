<?php

/**
 * Class Generate XML
 * @author hunter.nainggolan
 * @date 22 November 2012
 */
class Xml_generator {
	private $_dom;
	var $data = array ();
	var $file_path;
	var $str_xml;
	
	/**
	 *
	 * @access public
	 * @author hunter.nainggolan
	 *         @date 02 June 2014
	 * @param type $data        	
	 * @param type $path        	
	 */
	public function __construct() {
	}
	public function new_doc() {
		$this->_dom = new DOMDocument ( "1.0", 'UTF-8' );
		$this->generate_xml ( $this->_dom, $this->_dom );
	}
	
	/**
	 * generate_xml
	 * function to write xml doc
	 *
	 * @author hunter.nainggolan
	 *         @date 02 June 2014
	 *        
	 * @access public
	 * @return void
	 */
	public function generate_xml($root, $main) {
		foreach ( $this->data as $key => $val ) {
			if (is_numeric ( $key )) {
				$this->data = $val;
				$this->generate_xml ( $root, $main );
			} else {
				if ($key != 'attrib') {
					$tag = $main->createElement ( $key );
					if (! is_array ( $val )) {
						$root->appendChild ( $tag );
						$tag->nodeValue = $val;
					} else {
						foreach ( $val as $atrname => $isi ) {
							if ($atrname === 'attrib') {
								foreach ( $isi as $name => $row ) {
									$atr = $main->createAttribute ( $name );
									$atr->value = $row;
									$tag->appendChild ( $atr );
								}
							}
						}
						$root->appendChild ( $tag );
						$this->data = $val;
						$this->generate_xml ( $tag, $main );
					}
				}
			}
		}
		$main->formatOutput = true;
		$main->save ( $this->file_path );
	}
}
class Sitemap extends Xml_generator {
	private $_ci;
	var $range_date = array ();
	function __construct($start_date = null, $end_date = null, $path = 'sitemap_contest.xml') {
		parent::__construct ();
		$this->_ci = & get_instance ();
		$this->_ci->load->model ( 'wc_article' );
		$this->range_date = array (
				'start_date' => $start_date,
				'end_date' => $end_date 
		);
		$this->file_path = $path;
	}
	function run() {
		$i = 0;
		$contest_data = $this->_ci->wc_article->get_data_by_range_date ( $this->range_date ['start_date'], $this->range_date ['end_date'] );
		
		$this->data ['urlset'] = array (
				'attrib' => array (
						'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
						'xmlns:news' => 'http://www.google.com.schemas/sitemap-news/0.9' 
				) 
		);
		foreach ( $contest_data as $rec_contest ) {
			$this->data ['urlset'] [$i] = array (
					'url' => array (
							'loc' => $rec_contest->type == 'Article' ? get_permalink ( $rec_contest->id . '/' . urlencode ( $rec_contest->title ), 'read', 'article' ) : get_permalink ( $rec_contest->id . '/' . urlencode ( $rec_contest->title ), 'read', 'photo' ),
							'lastmod' => date ( 'Y-m-d' ),
							'changefreq' => 'daily',
							'priority' => '0.9' 
					) 
			);
			$i ++;
		}
		$this->new_doc ();
		
		$this->data = null;
		$this->file_path = 'sitemap_main.xml';
		
		$arr_link = array (
				"http://contest.jawaban.com",
				"http://contest.jawaban.com/home/index.html",
				"http://contest.jawaban.com/#about",
				"http://contest.jawaban.com/#information",
				"http://contest.jawaban.com/#article",
				"http://contest.jawaban.com/#photos",
				"http://contest.jawaban.com/#faq",
				"http://contest.jawaban.com/archive/photo.html",
				"http://contest.jawaban.com/archive/article.html",
				"http://contest.jawaban.com/register.html" 
		);
		$this->data ['urlset'] = array (
				'attrib' => array (
						'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9' 
				) 
		);
		$i = 0;
		foreach ( $arr_link as $link ) {
			$this->data ['urlset'] [$i] = array (
					'url' => array (
							'loc' => $link,
							'lastmod' => date ( 'Y-m-d' ),
							'changefreq' => 'daily',
							'priority' => '0.8' 
					) 
			);
			$i ++;
		}
		$this->new_doc ();
		$this->data = null;
		$this->file_path = 'sitemapindex.xml';
		$arr_link = array (
				"http://contest.jawaban.com/sitemap_contest.xml",
				"http://contest.jawaban.com/sitemap_main.xml" 
		);
		$this->data ['urlset'] = array (
				'attrib' => array (
						'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9' 
				) 
		);
		$i = 0;
		foreach ( $arr_link as $link ) {
			$this->data ['urlset'] [$i] = array (
					'url' => array (
							'loc' => $link,
							'lastmod' => date ( 'Y-m-d' ) 
					) 
			);
			$i ++;
		}
		$this->new_doc ();
	}
}
class RSS extends Xml_generator {
	private $_ci;
	public $data = array ();
	
	/**
	 * __construct
	 * function for create_rss
	 *
	 * @author hunter.nainggolan
	 *         @date 26 November 2012
	 *        
	 * @param string $path
	 *        	location xml file
	 * @access public
	 * @return void
	 */
	function __construct($start_date = null, $end_date = null, $path = 'rss.xml') {
		parent::__construct ();
		$this->_ci = & get_instance ();
		$this->_ci->load->model ( 'wc_article' );
		$this->range_date = array (
				'start_date' => $start_date,
				'end_date' => $end_date 
		);
		$this->file_path = $path;
	}
	function run() {
		$this->set_head_rss ( 'contest.jawaban.com' );
		$i = 1;
		$contest_data = $this->_ci->wc_article->get_data_by_range_date ( $this->range_date ['start_date'], $this->range_date ['end_date'] );
		foreach ( $contest_data as $rec_contest ) {
			if ($rec_contest->type == 'Article')
				$text = "<img src ='$rec_contest->image' align='left' hspace=7 width=120 height=90 \>$rec_contest->preface";
			else
				$text = "<img src ='$rec_contest->image' align='left' hspace=7 width=120 height=90 \>$rec_contest->content";
			$this->data ['rss'] ['channel'] [6] [$i] = array (
					'item' => array (
							'title' => htmlspecialchars ( $rec_contest->title ),
							'link' => $rec_contest->type == 'Article' ? get_permalink ( $rec_contest->id . '/' . urlencode ( $rec_contest->title ), 'read', 'article' ) : get_permalink ( $rec_contest->id . '/' . urlencode ( $rec_contest->title ), 'read', 'photo' ),
							'description' => htmlspecialchars ( $text ) 
					) 
			);
			$i ++;
		}
		$this->new_doc ();
	}
	function set_head_rss($title) {
		$this->data ['rss'] = array (
				'attrib' => array (
						'version' => "2.0",
						'xmlns:atom' => 'http://www.w3.org/2005/Atom' 
				) 
		);
		$this->data ['rss'] ['channel'] [0] = array (
				'title' => $title 
		);
		$this->data ['rss'] ['channel'] [1] = array (
				'atom' => '' 
		);
		
		$this->data ['rss'] ['channel'] [2] = array (
				'link' => 'http://contest.jawaban.com' 
		);
		$this->data ['rss'] ['channel'] [3] = array (
				'description' => 'Writing and Photo Contest adalah event dari Jawaban.com' 
		);
		$this->data ['rss'] ['channel'] [4] = array (
				'language' => 'en-us' 
		);
		$this->data ['rss'] ['channel'] [5] = array (
				'copyright' => '2014 Jawaban.com' 
		);
		$this->data ['rss'] ['channel'] [6] = array (
				0 => array (
						'image' => array (
								'title' => 'Jawaban.com',
								'link' => 'http://contest.jawaban.com',
								'url' => 'http://contest.jawaban.com/rss.png',
								'width' => 16,
								'height' => 16 
						) 
				) 
		);
	}
}
?>
