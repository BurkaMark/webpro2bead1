<?php
    class TrailsSoap extends Controller
    {
        /* Constructor */
        public function __construct()
        {
            $this->trailsModel = $this->model('Trail');
        }

        /* Function to get the trail by it's name */
        public function getTrailByName()
        {
            $data = [   'name' => '',
                        'trail' => '',
                        'nameError' => '',
                        'trailError' => '',
                        'setlmError' => '',
                        'npError' => ''];

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [   'name' => trim($_POST['name']),
                            'trail' => '',
                            'nameError' => '',
                            'trailError' => '',
                            'setlmError' => '',
                            'npErrpr' => ''];

                if(empty($data['name']))
                {
                    $data['nameError'] = 'Kérem adja meg a tanösvény nevét!';
                }

                if(empty($data['nameError']))
                {
                    $trail = $this->trailsModel->getTrailByName($data['name']);

                    if($trail == 1)
                    {
                        $data['trailError'] = 'A megadott nevű tanösvény nem található adatbázisunkban.';
                    }
                    elseif($trail == 2)
                    {
                        $data['setlmError'] = 'A ' . trim($data['name']) . ' tanösvényhez tartozó település információ hibás. Kérem, értsítse az adminisztrátort!';
                    }
                    elseif($trail == 3)
                    {
                        $data['npError'] = 'A ' . trim($data['name']) . ' tanösvényhez tartozó nemzeti park információ hibás. Kérem, értsítse az adminisztrátort!';
                    }

                    if(empty($data['trailError']) && empty($data['setlmError']) && empty($data['npError']))
                    {
                        $data['trail'] = $trail;
                    }
                }
            }
            else
            {
                $data = [   'name' => '',
                            'trail' => '',
                            'nameError' => '',
                            'trailError' => '',
                            'setlmError' => '',
                            'npError' => '']; 
            }

            $this->view('trail', $data);
        }

        /* Function to get the trail by the settlement it belongs to */
        public function getTrailBySettlement()
        {
            $data = [   'settlement' => '',
                        'trail' => '',
                        'nameError' => '',
                        'trailError' => '',
                        'setlmError' => '',
                        'npError' => ''];

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [   'settlement' => trim($_POST['settlement']),
                            'nameError' => '',
                            'trailError' => '',
                            'setlmError' => '',
                            'npErrpr' => ''];

                if(empty($data['settlement']))
                {
                    $data['nameError'] = 'Kérem adja meg a település nevét!';
                }

                if(empty($data['nameError']))
                {
                    $trail = $this->trailsModel->getTrailByName($data['settlement']);

                    if($trail == 1)
                    {
                        $data['setlmError'] = 'A megadott település nem található adatbázisunkban.';
                    }
                    elseif($trail == 2)
                    {
                        $data['trailError'] = 'A ' . trim($data['settlement']) . ' településhez tartozó tanösvény információ hibás. Kérem, értsítse az adminisztrátort!';
                    }
                    elseif($trail == 3)
                    {
                        $data['npError'] = 'A ' . trim($data['settlement']) . ' településhez tartozó nemzeti park információ hibás. Kérem, értsítse az adminisztrátort!';
                    }

                    if(empty($data['trailError']) && empty($data['setlmError']) && empty($data['npError']))
                    {
                        $data['trail'] = $trail;
                    }
                }
            }
            else
            {
                $data = [   'settlement' => '',
                            'trail' => '',
                            'nameError' => '',
                            'trailError' => '',
                            'setlmError' => '',
                            'npError' => '']; 
            }

            $this->view('trail', $data);
        }

        /* Function to get the trail by thy national park it belongs to */
        public function getTrailByNationalPark()
        {
            $data = [   'nat_park' => '',
                        'trail' => '',
                        'nameError' => '',
                        'trailError' => '',
                        'setlmError' => '',
                        'npError' => ''];

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [   'settlenat_parkment' => trim($_POST['nat_park']),
                            'nameError' => '',
                            'trailError' => '',
                            'setlmError' => '',
                            'npErrpr' => ''];

                if(empty($data['nat_park']))
                {
                    $data['nameError'] = 'Kérem adja meg a nemzeti park nevét!';
                }

                if(empty($data['nameError']))
                {
                    $trail = $this->trailsModel->getTrailByName($data['nat_park']);

                    if($trail == 1)
                    {
                        $data['npError'] = 'A megadott nemzeti park nem található adatbázisunkban.';
                    }
                    elseif($trail == 2)
                    {
                        $data['setlmError'] = 'A ' . trim($data['nat_park']) . ' nemzeti parkhoz tartozó település információ hibás. Kérem, értsítse az adminisztrátort!';
                    }
                    elseif($trail == 3)
                    {
                        $data['trailError'] = 'A ' . trim($data['nat_park']) . ' nemzeti parkhoz tartozó tanösvény információ hibás. Kérem, értsítse az adminisztrátort!';
                    }

                    if(empty($data['trailError']) && empty($data['setlmError']) && empty($data['npError']))
                    {
                        $data['trail'] = $trail;
                    }
                }
            }
            else
            {
                $data = [   'nat_park' => '',
                            'trail' => '',
                            'nameError' => '',
                            'trailError' => '',
                            'setlmError' => '',
                            'npError' => '']; 
            }

            $this->view('trail', $data);
        }
    }
?>