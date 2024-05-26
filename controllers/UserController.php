<?php  
  // file: server/controllers/ProfessorController.php 
  require_once(__DIR__ . '/../models/User.php');

class UserController extends Controller {
  
  public function index() {  
    return User::all();
  }  
  
  public function store($request) {
    return User::create($request);
  }  
  
  public function show($id) {  
    return User::find($id);
  }  
  
  public function update($request,$id) {  
    return User::update($id,$request);
  }  
  
  public function destroy($id) {  
    return User::destroy($id);
  }
}
?>