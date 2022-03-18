<?php
    class Users extends Controller 
    {
        public function __construct() 
        {
            $this->userModel = $this->model('User');
        }

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
                    'email'                 => trim($_POST['email'])
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

                $nameValidation     = "/^[a-zA-Z0-9]*$/";
                $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

                if (empty($data['username'])) 
                {
                    $data['usernameError'] = 'Kérem adja meg a felhasználói nevet.';
                }
                elseif (!preg_match($nameValidation, $data['username'])) 
                {
                    $data['usernameError'] = 'A felhasználói név csak betüket és számokat tartalmazhat.';
                }

                if (empty($data['email']))
                {
                    $data['emailError'] = 'Kérem adja meg az e-mail címet.';
                }
                elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
                {
                    $data['emailError'] = 'Kérem adja meg az e-mail címet a megfelelő formátumban (valaki@valami.hu).';
                }
                else
                {
                    if ($this->userModel->findUserByEmail($data['email']))
                    {
                        $data['emailError'] = 'Ezzel az e-mail címmel már regisztráltak.';
                    }
                }

                if(empty($data['password']))
                {
                    $data['passwordError'] = 'Kérem adja meg a jelszót.';
                } 
                elseif(strlen($data['password']) < 8)
                {
                    $data['passwordError'] = 'A jelszó legalább 8 karakter hosszú kell legyen.';
                } 
                elseif (preg_match($passwordValidation, $data['password'])) 
                {
                    $data['passwordError'] = 'A jelszónak legalább egy számot kell tartalmaznia.';
                }

                if (empty($data['confirmPassword'])) 
                {
                    $data['confirmPasswordError'] = 'Kérem adja meg a jelszót.';
                } 
                else 
                {
                    if ($data['password'] != $data['confirmPassword']) 
                    {
                        $data['confirmPasswordError'] = 'A megadott jelszavak nem egyeznek. Kérem próbálja meg újra.';
                    }
                }

                if (empty($data['lastName']))
                {
                    $data['lastNameError'] = 'Kérem adja meg családi nevét.'; 
                }

                if (empty($data['firstName']))
                {
                    $data['firstNameError'] = 'Kérem adja meg keresztnevét.'; 
                }

                if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError']) && empty($data['lastNameError']) && empty($data['firstNameError'])) 
                {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    if ($this->userModel->register($data)) 
                    {
                        header('location: ' . URLROOT . '/users/login');
                    } 
                    else 
                    {
                        die('Valami hibára futott.');
                    }
                }
            }

            $this->view('users/register', $data);
        }

        public function login() 
        {
            $data = [
                'title'         => 'Bejelentkezés',
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
                    $data['usernameError'] = 'Kérem adja meg a felhasználói nevet.';
                }

                if (empty($data['password'])) 
                {
                    $data['passwordError'] = 'Kérem adja meg a jelszót.';
                }

                if (empty($data['usernameError']) && empty($data['passwordError'])) 
                {
                    $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                    if ($loggedInUser) 
                    {
                        $this->createUserSession($loggedInUser);
                    } 
                    else 
                    {
                        $data['passwordError'] = 'A felhasználói név, vagy a jelszó nem megfelelő. Kérem próbálja meg újra.';
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

        public function createUserSession($user) 
        {
            $_SESSION['user_id']    = $user->id;
            $_SESSION['username']   = $user->username;

            header('location:' . URLROOT . '/pages/index');
        }

        public function logout() 
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);

            header('location:' . URLROOT . '/users/login');
        }
    }