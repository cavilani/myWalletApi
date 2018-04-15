<?php


namespace App\Http\Controllers;

class ApiController extends Controller {

	static $version = '1.0.0';

	const CODE_INVALID_REQUEST = '400';


	public function apiVersion() {
		return response()->json(['data' => self::$version]);
	} 

	public function errorResponse($message) {
		return response('Invalid request ('.$message.')', SELF::CODE_INVALID_REQUEST)
            	->header('Content-Type', 'text/plain');
	}

	public function successResponse() {

		return response()->json(self::getSuccessResponse());
	}

	public static function getSuccessResponse() {

		return ['message' => 'Success'];
	}

}