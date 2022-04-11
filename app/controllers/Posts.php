<?php
    class Posts extends Controller
    {
        public function __construct()
        {
            $this->postModel = $this->model('Post');
        }

        public function index()
        {
            $posts = $this->postModel->findAllPosts();

            $data = ['posts' => $posts];

            $this->view('/posts/index', $data);
        }

        public function create()
        {
            if(!isLoggedIn())
            {
                header("Location: " . URLROOT . "/posts");
            }

            $data = ['title' => '',
                        'body' => '',
                        'titelError' => '',
                        'bodyError' => ''];

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = ['user_id' => $_SESSION['user_id'],
                            'title' => trim($_POST['title']),
                            'body' => trim($_POST['body']),
                            'created' => date("Y-m-d"),
                            'titleError' => '',
                            'bodyError' => ''];
                
                if(empty($data['title']))
                {
                    $data['titleError'] = "A bejegyzés címe nem lehet üres!";
                }
                if(empty($data['body']))
                {
                    $data['bodyError'] = "Üres tartalmú bejegyzés nem rögzíthető!";
                }

                if(empty($data['titleError']) && empty($data['bodyError']))
                {
                    if($this->postModel->addPost($data))
                    {
                        header("Location: " . URLROOT . "/posts");
                    }
                    else
                    {
                        die("Hiba történt, kérem próbálja meg ismét.");
                    }
                }

                $this->view('posts/create', $data);
            }
        }

        public function update($id)
        {
            $post = $this->postModel->findPostById($id);

            if(!isLoggedIn())
            {
                header("Location: " . URLROOT . "/posts");
            }
            elseif($post->user_id != $_SESSION['user_id'])
            {
                header("Location: " . URLROOT . "/posts");
            }

            $data = ['post' => $post,
                        'title' => '',
                        'body' => '',
                        'titleError' => '',
                        'bodyError' => ''];

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = ['id' => $id,
                            'post' => $post,
                            'user_id' => $_SESSION['user_id'],
                            'title' => trim($_POST['title']),
                            'body' => trim($_POST['body']),
                            'modified' => date("Y-m-d"),
                            'titleError' => '',
                            'bodyError' => ''];

                if(empty($data['title']))
                {
                    $data['titleError'] = 'A bejegyzés címe nem lehet üres!';
                }
    
                if(empty($data['body']))
                {
                    $data['bodyError'] = 'A bejegyzés tartalma nem lehet üres!';
                }
    
                if($data['title'] == $this->postModel->findPostById($id)->title && $data['body'] == $this->postModel->findPostById($id)->body)
                {
                    $data['titleError'] = 'Kérem módostsa vagy a címet, vagy a bejegyzés tartalmát!';
                    $data['bodyError'] = 'Kérem módostsa vagy a címet, vagy a bejegyzés tartalmát!';
                }
    
                if (empty($data['titleError']) && empty($data['bodyError']))
                {
                    if ($this->postModel->updatePost($data))
                    {
                        header("Location: " . URLROOT . "/posts");
                    }
                    else
                    {
                        die("Hiba történt, kérem próbálja meg ismét.");
                    }
                }

                $this->view('posts/update', $data);
            }
        }

        public function delete($id)
        {
            $post = $this->postModel->findPostById($id);
    
            if(!isLoggedIn())
            {
                header("Location: " . URLROOT . "/posts");
            }
            elseif($post->user_id != $_SESSION['user_id'])
            {
                header("Location: " . URLROOT . "/posts");
            }
    
            $data = ['post' => $post,
                        'title' => '',
                        'body' => '',
                        'titleError' => '',
                        'bodyError' => ''];
    
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                if($this->postModel->deletePost($id))
                {
                    header("Location: " . URLROOT . "/posts");
                }
                else
                {
                   die("Hiba történt, kérem próbálja meg ismét.");
                }
            }
        }
    }
?>