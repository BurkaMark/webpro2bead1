<?php
    class Trails
    {
        /* Private variables */
        private $db;

        /* Constructor */
        public function __construct()
        {
            $this->db = new Database;
        }

        /* Get the details of a trail by searching for it's name */
        public function getTrailByName($name)
        {
            $this->db->query('SELECT * FROM ut WHERE nev = :name');
            $this->db->bind(':name', $name);

            if($this->db->rowCount() > 0)
            {
                $row = $this->db->single();

                $trail_name = $row->nev;
                $trail_length = $row->hossz;
                $trail_stops = $row->allomas;
                $trail_time = $row->ido;
                $trail_guide = $row->vezetes;
                $trail_set_id = $row->telepulesid;

                $this->db->query('SELECT * FROM telepules WHERE id = :trail_set_id');
                $this->db->bind(':trail_set_id', $trail_set_id);

                if($this->db->rowCount() > 0)
                {
                    $row = $this->db->single();

                    $trail_setlem = $row->nev;
                    $trail_np_id = $row->npid;

                    $this->db->query('SELECT * FROM np WHERE id = :trail_np_id');
                    $this->db->bind(':trail_np_id', $trail_np_id);
                    
                    if($this->db->rowCount() > 0)
                    {
                        $row = $this->db->single();

                        $trail_np = $row->nev;
                    }
                    else
                    {
                        return 3;
                    }
                }
                else
                {
                    return 2;
                }
            }
            else
            {
                return 1;
            }

            $result = [ 'name'      => $trail_name,
                        'length'    => $trail_length,
                        'stops'     => $trail_stops,
                        'time'      => $trail_time,
                        'guide'     => $trail_guide,
                        'setlement' => $trail_setlem,
                        'np'        => $trail_np];

            return $result;
        }

        /* Get the details of a trail by searching the settlement it belongs to */
        public function getTrailBySettlement($settlement)
        {
            $this->db->query('SELECT * FROM telepules WHERE nev = :settlement');
            $this->db->bind(':settlement', $settlement);

            if($this->db->rowCount() > 0)
            {
                $row = $this->db->single();

                $trail_set_id = $row->id;
                $trail_setlem = $row->nev;
                $trail_np_id = $row->npid;

                $this->db->query('SELECT * FROM ut WHERE telepulesid = :trail_set_id');
                $this->db->bind(':trail_set_id', $trail_set_id);

                if($this->db->rowCount() > 0)
                {
                    $row = $this->db->single();

                    $trail_name = $row->nev;
                    $trail_length = $row->hossz;
                    $trail_stops = $row->allomas;
                    $trail_time = $row->ido;
                    $trail_guide = $row->vezetes;
                }
                else
                {
                    return 2;
                }

                $this->db->query('SELECT * FROM np WHERE id = :trail_np_id');
                $this->db->bind(':trail_np_id', $trail_np_id);

                if($this->db->rowCount() > 0)
                {
                    $row = $this->db->single();

                    $trail_np = $row->nev;
                }
                else
                {
                    return 3;
                }
            }
            else
            {
                return 1;
            }

            $result = [ 'name'      => $trail_name,
                        'length'    => $trail_length,
                        'stops'     => $trail_stops,
                        'time'      => $trail_time,
                        'guide'     => $trail_guide,
                        'setlement' => $trail_setlem,
                        'np'        => $trail_np];

            return $result;
        }

        /* Get the details of a trail by searching for the national par it belongs to */
        public function getTrailByNationalPark($nat_park)
        {
            $this->db->query('SELECT * FROM np WHERE nev = :nat_park');
            $this->db->bind(':nat_park', $nat_park);

            if($this->db->rowCount() > 0)
            {
                $row = $this->db->single();

                $trail_np_id = $row->id;
                $trail_np = $row->nev;

                $this->db->query('SELECT * FROM telepules WHERE npid = :trail_np_id');
                $this->db->bind(':trail_np_id', $trail_np_id);

                if($this->db->rowCount() > 0)
                {
                    $row = $this->db->single();

                    $trail_set_id = $row->id;
                    $trail_setlem = $row->nev;

                    $this->db->query('SELECT * FROM ut WHERE telepulesid = :trail_set_id');
                    $this->db->bind(':trail_set_id', $trail_set_id);

                    if($this->db->rowCount() > 0)
                    {
                        $row = $this->db->single();

                        $trail_name = $row->nev;
                        $trail_length = $row->hossz;
                        $trail_stops = $row->allomas;
                        $trail_time = $row->ido;
                        $trail_guide = $row->vezetes;
                    }
                    else
                    {
                        return 3;
                    }
                }
                else
                {
                    return 2;
                }
            }
            else
            {
                return 1;
            }

            $result = [ 'name'      => $trail_name,
                        'length'    => $trail_length,
                        'stops'     => $trail_stops,
                        'time'      => $trail_time,
                        'guide'     => $trail_guide,
                        'setlement' => $trail_setlem,
                        'np'        => $trail_np];

            return $result;
        }
    }
?>