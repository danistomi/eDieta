<?php

namespace App\DataObject;


class SurgeryProperties {
	/**
	 * @var string $doctorName
	 */
	public $doctorName = null;
	public $ordinationHours = [
		'monday'    => [ 'from' => null, 'to' => null ],
		'tuesday'   => [ 'from' => null, 'to' => null ],
		'wednesday' => [ 'from' => null, 'to' => null ],
		'thursday'  => [ 'from' => null, 'to' => null ],
		'friday'    => [ 'from' => null, 'to' => null ],
		'saturday'  => [ 'from' => null, 'to' => null ],
		'sunday'    => [ 'from' => null, 'to' => null ],
	];

	public function getJson() {
		return json_encode( [ 'doctorName' => $this->doctorName, 'ordinationHours' => $this->ordinationHours ] );
	}

}