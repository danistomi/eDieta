<?php

namespace App\Components;


class BmiFileParser {
	private $content;

	public function setContent( $content ) {
		$this->content = $content;

		return $this;
	}

	public function parse() {
		$rows   = explode( "\n", $this->content );
		$header = array_shift( $rows );
		$res    = array();
		foreach ( $rows as $row => $data ) {
			$row_data = explode( "\t", $row );
			dd( $rows );
		}
	}

}