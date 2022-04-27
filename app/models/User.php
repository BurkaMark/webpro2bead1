<?php
    class User
    {
        private $db;

        /* Constructor */
        public function __construct()
        {
            $this->db = new Database;
        }

        /* Function to register a user */
        public function register($data) 
        {
            $this->db->query('INSERT INTO felhasznalok (username, keresztnev, vezeteknev, email, jelszo) VALUES(:username, :lastName, :firstName, :email, :password)');
    
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':lastName', $data['lastName']);
            $this->db->bind(':firstName', $data['firstName']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

    
            if ($this->db->execute()) 
            {
                return true;
            } 
            else 
            {
                return false;
            }
        }

        /* Function to login a user */
        public function login($username, $password) {
            $this->db->query('SELECT * FROM felhasznalok WHERE username = :username');
    
            $this->db->bind(':username', $username);
            $row = $this->db->single();
            $hashedPassword = $row->jelszo;
    
            if (password_verify($password, $hashedPassword))
            {
                return $row;
            } 
            else 
            {
                return false;
            }
        }

        /* Function to find a user by username */
        public function findUserByUsername($username)
        {
            $this->db->query('SELECT * FROM felhasznalok WHERE username = :username');

            $this->db->bind(':username', $username);

            if ($this->db->rowCount() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        /* Function to find a user by email */
        public function findUserByEmail($email)
        {
            $this->db->query('SELECT * FROM felhasznalok WHERE email = :email');
            $this->db->bind(':email', $email);
    
            if($this->db->rowCount() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>