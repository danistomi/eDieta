<?php

namespace App\Components;


class BmiFileParser {
	private $content;
	private $columns;

	public function __construct() {
		$this->columns = [
			'sd3neg' => 'SD3neg',
			'sd2neg' => 'SD2neg',
			'sd1neg' => 'SD1neg',
			'sd0'    => 'SD0',
			'sd1'    => 'SD1',
			'sd2'    => 'SD2',
			'sd3'    => 'SD3',
		];
	}

	public function setContent( $content ) {
		$this->content = $content;

		return $this;
	}

	public function parse() {
		$rows       = explode( "\n", $this->content );
		$header     = array_shift( $rows );
		$headerData = array();
		$header     = explode( "\t", $header );

		foreach ( $header as $item => $value ) {
			$header[ $item ] = $value = trim( preg_replace( '/\s+/', ' ', $value ) );
		}

		foreach ( $this->columns as $key => $column ) {
			$headerData[ $key ] = array_search( $column, $header );
		}
		$res = array();

		foreach ( $rows as $data ) {
			$row_data = explode( "\t", $data );
			if ( count( $row_data ) < 2 ) {
				continue;
			}
			foreach ( $row_data as $item => $value ) {
				$row_data[ $item ] = $value = trim( preg_replace( '/\s+/', ' ', $value ) );
			}
			$res[ (int) $row_data[0] ] = array();

			foreach ( $this->columns as $key => $column ) {
				$res[ (int) $row_data[0] ][ $key ] = $row_data[ $headerData[ $key ] ];
			}
		}

		return $res;
	}

}