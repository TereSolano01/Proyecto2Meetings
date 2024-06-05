<?php 
require_once(__DIR__ . '/../models/Calendario.php');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Manejo de las solicitudes OPTIONS (Preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

class CalendarioController extends Controller {
  
  public function home()
  {
    return view(
      'calendario/index',
      [
        'reuniones' => Calendario::all(),
        'title' => 'Reuniones'
      ]
    );
  }

  public function index() {  
    return Calendario::all();
  }  
  
  public function store($request = NULL) {
    return Calendario::create($request);
  }  
  
  public function show($id) {  
    return Calendario::find($id);
  }  
  
  public function update($request, $id = NULL) {  
    if (!$id) {
        http_response_code(400);
        return ['error' => 'ID is required'];
    }

    $calendario = Calendario::find($id);
    if (!$calendario) {
        http_response_code(404);
        return ['error' => 'Calendario not found'];
    }

    $updated = $calendario->update($request);
    if ($updated) {
        return ['message' => 'Calendario updated successfully'];
    } else {
        http_response_code(500);
        return ['error' => 'Failed to update Calendario'];
    }
  }  
  
  public function destroy($id) {  
    if (Calendario::destroy($id)) {
        return ['message' => 'Calendario deleted successfully'];
    } else {
        http_response_code(500);
        return ['error' => 'Failed to delete Calendario'];
    }
  }
}
?>
