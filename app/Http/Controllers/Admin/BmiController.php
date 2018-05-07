<?php

namespace App\Http\Controllers\Admin;

use App\Components\BmiFileParser;
use App\Http\Requests\StoreBmiFile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BmiController extends Controller {


	public function __construct() {
		$this->middleware( 'auth' );
	}


	public function storeBmiFile( StoreBmiFile $request ) {
		//Storage::disk( 'local' )->put( 'file.txt', 'Contents' );
		$filename = $request->file( 'bmiFile' )->getClientOriginalName();
		$path     = $request->file( 'bmiFile' )->store( 'bmiFiles' );

		DB::table( 'bmi_files' )->insert( [
			'file_name'         => $filename,
			'storage_file_name' => $path,
			'gender'            => $request->gender,
			"created_at"        => Carbon::now(),
			"updated_at"        => Carbon::now()
		] );


		return redirect()->back();
	}

	public function storeBmi( $fileId ) {
		$file    = DB::table( 'bmi_files' )->where( 'id', $fileId )->first();
		$content = Storage::get( $file->storage_file_name );
		$parser  = new BmiFileParser();
		$parser->setContent( $content )->parse();
	}

	public function destroy( $fileId ) {
		$file = DB::table( 'bmi_files' )->where( 'id', $fileId )->first();

		Storage::delete( $file->storage_file_name );

		DB::table( 'bmi_files' )->where( 'id', $fileId )->delete();

		return redirect()->back();
	}
}
