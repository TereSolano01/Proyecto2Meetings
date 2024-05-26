<?php  
  // file: server/controllers/ProfessorController.php 
  require_once(__DIR__ . '/../models/Calendario.php');

class CalendarioController extends Controller {
  
  public function index() {  
    return Calendario::all();
  }  
  
  public function store($request) {
    return Calendario::create($request);
  }  
  
  public function show($id) {  
    return Calendario::find($id);
  }  
  
  public function update($request,$id) {  
    return Calendario::update($id,$request);
  }  
  
  public function destroy($id) {  
    return Calendario::destroy($id);
  }
}
?>