<?php  
  // file: server/controllers/ProfessorController.php 
  require_once(__DIR__ . '/../models/Professor.php');

class ProfessorController extends Controller {
  
  public function index() {  
    return Professor::all();
  }  
  
  public function store($param1 = NULL) {

    return Professor::create($param1); 
  }  
  
  public function show($id) {  
    return Professor::find($id);
  }  
  
  public function update($request,$id = NULL) {  
    return Professor::update($id,$request);
  }  
  
  public function destroy($id) {  
    return Professor::destroy($id);
  }
}
?>