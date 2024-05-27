<?php  
  // file: server/controllers/ProfessorController.php 
  require_once(__DIR__ . '/../models/Calendario.php');

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
  
  public function update($request,$id = NULL) {  
    return Calendario::update($id,$request);
  }  
  
  public function destroy($id) {  
    return Calendario::destroy($id);
  }
}
?>