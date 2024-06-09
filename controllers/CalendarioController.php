<?php 
require_once(__DIR__ . '/../models/Calendario.php');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

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

  private function getUserByEmail($email) {
    $apiUrl = 'https://calendarmeetings.000webhostapp.com/server/user';
    $users = file_get_contents($apiUrl);
    $users = json_decode($users, true);

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return (object) $user;
        }
    }
    return null;
  }

  public function shareMeeting($request = NULL) {
    if (!$request || !isset($request['email']) || !isset($request['calendar_id'])) {
        http_response_code(400);
        return ['error' => 'Invalid request'];
    }

    $email = $request['email'];
    $calendarId = $request['calendar_id'];

    $user = $this->getUserByEmail($email);
    if (!$user) {
        http_response_code(404);
        return ['error' => 'User not found'];
    }

    $originalMeeting = Calendario::find($calendarId);
    if (!$originalMeeting) {
        http_response_code(404);
        return ['error' => 'Meeting not found'];
    }

    $newMeeting = [
        'titulo' => $originalMeeting->titulo,
        'descripcion' => $originalMeeting->descripcion,
        'dia' => $originalMeeting->dia,
        'mes' => $originalMeeting->mes,
        'anio' => $originalMeeting->anio,
        'hora_inicio' => $originalMeeting->hora_inicio,
        'hora_fin' => $originalMeeting->hora_fin,
        'ubicacion' => $originalMeeting->ubicacion,
        'user_id' => $user->id
    ];
    
    if (Calendario::create($newMeeting)) {
        return ['message' => 'Meeting shared successfully'];
    } else {
        http_response_code(500);
        return ['error' => 'Failed to share meeting'];
    }
  }
}
?>