<?php
class Authenticate extends DatabaseClient {

    public $username;
    public $email;
    public $password;

    public function authenticate_user()
    {
        $query = "SELECT username, email, password FROM users WHERE useranem =?
              AND email =? AND password=?
              LIMIT 1";
        //prepare query and execute
        if(!$stmt = $this->connection->prepare($query))
        {
            print "Failed to prepare statement";
        }
        else
        {
            $stmt->bind_param('ss', $this->username, $this->email, $this->password);
            $stmt->execute();
            $stmt->bind_result($username, $email, $password);
            $stmt->store_result();
            $stmt->fetch();

            if($stmt->num_rows > 0)
            {
                $this->status = 'Logged In';
                $this->setSessions();
            }
            else {
                $this->status = 'Not Logged In';
            }
        }
        $stmt->close();
        echo json_encode(array($this->status));

    }
}