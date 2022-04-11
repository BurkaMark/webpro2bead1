<?php
    class Post
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function findAllPosts()
        {
            $this->db->query('SELECT * FROM bejegyzesek ORDER BY letrehozva ASC');

            $results = $this->db->resultSet();

            return $results;
        }

        public function addPost($data)
        {
            $this->db->query('INSERT INTO bejegyzesek (userid, cim, tartalom, letrehozva) VALUES (:user_id, :title, :body, :created)');

            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':created', $data['created']);

            if($this->db->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function findPostById($id)
        {
            $this->db->query('SELECT * FROM bejegyzesek WHERE id = :id');

            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function updatePost($data)
        {
            $this->db->query('UPDATE bejegyzesek SET cim = :title, tartalom = :body, modositva = :modified WHERE id = :id');

            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':modified', $data['modified']);

            if($this->db->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function deletePost($id)
        {
            $this->db->query('DELETE FROM bejegyzesek WHERE id = :id');

            $this->db->bind(':id', $id);

            if($this->db->execute())
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