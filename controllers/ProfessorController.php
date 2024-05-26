<?php  
  // file: server/controllers/ProfessorController.php 
  require_once(__DIR__ . '/../models/Professor.php');

class ProfessorController extends Controller {
  
  public function index() {  
    return Professor::all();
  }  
  
  public function store($request) {
    return Professor::create($request);
  }  
  
  public function show($id) {  
    return Professor::find($id);
  }  
  
  public function update($request,$id) {  
    return Professor::update($id,$request);
  }  
  
  public function destroy($id) {  
    return Professor::destroy($id);
  }
}
?>