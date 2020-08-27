<?php 

namespace Ahost\Generators;

use App\Http\Controllers\Controller;

class GeneratorController extends Controller {

  public function __construct() {
    //
  }

  /**
  * Requests Instagram pics.
  *
  * @return Response
  */
  public static function grabInstagram()
  { 
    $data = "Hello!";
    return $data;
  }
}