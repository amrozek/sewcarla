<?
set_error_handler('exceptions_error_handler');
function exceptions_error_handler($severity, $message, $filename, $lineno) {
	if (error_reporting() == 0) {
		return;
	}
	if (error_reporting() & $severity) {
		throw new ErrorException($message, 0, $severity, $filename, $lineno);
	}
}

$images = glob('images/*.{JPG,jpg,GIF,gif,PNG,png}', GLOB_BRACE);
$thumbnails = glob('images/thumbnails/*.{JPG,jpg,GIF,gif,PNG,png}', GLOB_BRACE);
$data = array();

for($i=$_POST["bound1"]; $i<$_POST["bound2"]; $i++){ 
	try {
		$data[$images[$i]] = $thumbnails[$i];
	}
	catch (Exception $e) {
		$data[""] = "";
		break;
	}
}

echo json_encode($data);

?>