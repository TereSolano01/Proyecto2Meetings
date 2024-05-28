<?php
public function login() {
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type");

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      http_response_code(200);
      exit();
  }

  $data = json_decode(file_get_contents('php://input'), true);
  $email = $data['email'];
  $password = $data['password'];
  
  error_log("Login attempt with email: $email and password: $password");

  $url = 'https://meetingscalendar.000webhostapp.com/server/user';
  $users = $this->getUsersFromAPI($url);
  
  error_log("Users fetched from API: " . print_r($users, true));

  foreach ($users as $user) {
      if ($user->email == $email && $user->password == $password) {
          // Assuming you have a method to log in the user
          Auth::login($user);
          error_log("Login successful for user: $email");
          return response()->json(['success' => true]);
      }
  }

  error_log("Login failed for user: $email");
  return response()->json(['success' => false]);
}

?>