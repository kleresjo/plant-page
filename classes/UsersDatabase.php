<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/User.php";

class UsersDatabase extends Database{
    
    // get_one
    public function get_one_by_username($username){
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $db_user = mysqli_fetch_assoc($result);
        $user = null;

        if($db_user){
            $user = new User(
                $db_user["username"], 
                $db_user["role"], 
                $db_user["id"]);
            $user->set_password_hash($db_user["password-hash"]);
        }
        return $user;
    }
   
    // get_all
    public function get_all(){
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $query);
        $db_users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $users = [];

        foreach ($db_users as $db_user){
            $user = new User ($db_user["username"], $db_user["role"], $db_user["id"]);
            $users[] = $user;
        }
        return $users;
    }


    // create användare
    public function create(User $user){
        $query = "INSERT INTO users (username, `password-hash`, `role`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("sss", $user->username, $user->get_password_hash(), $user->role);
        $success = $stmt->execute();
        return $success;
    }

    // update användare
    public function update(User $user){
        $query = "UPDATE users SET `role`=? WHERE username=?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ss", $user->role, $user->username);
        return $stmt->execute();
    }

    // delete användare
    public function delete($username){
        $query = "DELETE FROM users WHERE username = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("s", $username);

        return $stmt->execute();
    }
}
