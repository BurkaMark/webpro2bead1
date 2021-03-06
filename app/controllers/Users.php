<?php
    class Users extends Controller 
    {
        /* Constructor */
        public function __construct() 
        {
            $this->userModel = $this->model('User');
        }

        /* Function to register a user */
        public function register() 
        {
            $data = [
                'username'              => '',
                'email'                 => '',
                'password'              => '',
                'confirmPassword'       => '',
                'lastName'              => '',
                'firstName'             => '',
                'usernameError'         => '',
                'emailError'            => '',
                'passwordError'         => '',
                'confirmPasswordError'  => '',
                'lastNameError'         => '',
                'firstNameError'        => ''
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'username'              => trim($_POST['username']),
                    'email'                 => trim($_POST['email']),
                    'password'              => trim($_POST['password']),
                    'confirmPassword'       => trim($_POST['confirmPassword']),
                    'lastName'              => trim($_POST['lastName']),
                    'firstName'             => trim($_POST['firstName']),
                    'usernameError'         => '',
                    'emailError'            => '',
                    'passwordError'         => '',
                    'confirmPasswordError'  => '',
                    'lastNameError'         => '',
                    'firstNameError'        => ''
                ];

                /* Validating input data */
                $nameValidation     = "/^[a-zA-Z0-9]*$/";
                $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

                if (empty($data['username'])) 
                {
                    $data['usernameError'] = 'K??rem adja meg a felhaszn??l??i nevet.';
                }
                elseif (!preg_match($nameValidation, $data['username'])) 
                {
                    $data['usernameError'] = 'A felhaszn??l??i n??v csak bet??ket ??s sz??mokat tartalmazhat.';
                }
                else
                {
                    if ($this->userModel->findUserByUsername($data['username']))
                    {
                        $data['usernameError'] = 'Ezzel a felhaszn??l??i n??vvel m??r regisztr??ltak.';
                    }
                }

                if (empty($data['email']))
                {
                    $data['emailError'] = 'K??rem adja meg az e-mail c??met.';
                }
                elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
                {
                    $data['emailError'] = 'K??rem adja meg az e-mail c??met a megfelel?? form??tumban (valaki@valami.hu).';
                }
                else
                {
                    if ($this->userModel->findUserByEmail($data['email']))
                    {
                        $data['emailError'] = 'Ezzel az e-mail c??mmel m??r regisztr??ltak.';
                    }
                }

                if(empty($data['password']))
                {
                    $data['passwordError'] = 'K??rem adja meg a jelsz??t.';
                } 
                elseif(strlen($data['password']) < 8)
                {
                    $data['passwordError'] = 'A jelsz?? legal??bb 8 karakter hossz?? kell legyen.';
                } 
                elseif (preg_match($passwordValidation, $data['password'])) 
                {
                    $data['passwordError'] = 'A jelsz??nak legal??bb egy sz??mot kell tartalmaznia.';
                }

                if (empty($data['confirmPassword'])) 
                {
                    $data['confirmPasswordError'] = 'K??rem adja meg a jelsz??t.';
                } 
                else 
                {
                    if ($data['password'] != $data['confirmPassword']) 
                    {
                        $data['confirmPasswordError'] = 'A megadott jelszavak nem egyeznek. K??rem pr??b??lja meg ??jra.';
                    }
                }

                if (empty($data['lastName']))
                {
                    $data['lastNameError'] = 'K??rem adja meg csal??di nev??t.'; 
                }

                if (empty($data['firstName']))
                {
                    $data['firstNameError'] = 'K??rem adja meg keresztnev??t.'; 
                }

                /* If everything is ok we can register the user */
                if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError']) && empty($data['lastNameError']) && empty($data['firstNameError'])) 
                {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    if ($this->userModel->register($data)) 
                    {
                        header('location: ' . URLROOT . '/users/login');
                    } 
                    else 
                    {
                        die('Valami hib??ra futott.');
                    }
                }
            }

            $this->view('users/register', $data);
        }

        /* Function to login the user */
        public function login() 
        {
            $data = [
                'title'         => 'Bejelentkez??s',
                'username'      => '',
                'password'      => '',
                'usernameError' => '',
                'passwordError' => ''
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST') 
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'username'      => trim($_POST['username']),
                    'password'      => trim($_POST['password']),
                    'usernameError' => '',
                    'passwordError' => '',
                ];
                
                if (empty($data['username'])) 
                {
                    $data['usernameError'] = 'K??rem adja meg a felhaszn??l??i nevet.';
                }

                if (empty($data['password'])) 
                {
                    $data['passwordError'] = 'K??rem adja meg a jelsz??t.';
                }

                /* If everything is ok we can log in the user */
                if (empty($data['usernameError']) && empty($data['passwordError'])) 
                {
                    $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                    if ($loggedInUser) 
                    {
                        $this->createUserSession($loggedInUser);
                    } 
                    else 
                    {
                        $data['passwordError'] = 'A felhaszn??l??i n??v, vagy a jelsz?? nem megfelel??. K??rem pr??b??lja meg ??jra.';
                        $this->view('users/login', $data);
                    }
                }

            }
            else 
            {
                $data = [
                    'username'      => '',
                    'password'      => '',
                    'usernameError' => '',
                    'passwordError' => ''
                ];
            }

            $this->view('users/login', $data);
        }

        /* Function to create a session for the user */
        public function createUserSession($user) 
        {
            $_SESSION['user_id']    = $user->id;
            $_SESSION['username']   = $user->username;
            $_SESSION['lastName']   = $user->vezeteknev;
            $_SESSION['firstName']  = $user->keresztnev;

            header('location:' . URLROOT . '/pages/index');
        }

        /* Function to log out the user */
        public function logout() 
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['lastName']);
            unset($_SESSION['firstName']);

            header('location:' . URLROOT . '/users/login');
        }
    }
?>