<?php
    class User
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function register($data) 
        {
            $this->db->query('INSERT INTO felhasznalok (username, keresztnev, vezeteknev, email, jelszo) VALUES(:username, :lastName, :firstName, :email, :password)');
    
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':lastName', $data['vezeteknev']);
            $this->db->bind(':firstName', $data['keresztnev']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['jelszo']);

    
            if ($this->db->execute()) 
            {
                return true;
            } 
            else 
            {
                return false;
            }
        }

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