<?php
    class Posts extends Controller
    {
        /* Constructor */
        public function __construct()
        {
            $this->postModel = $this->model('Post');
        }

        /* Index function to get all posts */
        public function index()
        {
            $posts = $this->postModel->findAllPosts();

            $data = ['posts' => $posts];

            $this->view('/posts/index', $data);
        }

        /* Function to create a new post */
        public function create()
        {
            /* Only registered and logged in users are allowd to create a new post */
            if(!isLoggedIn())
            {
                header("Location: " . URLROOT . "/posts");
            }

            $data = ['user_id' => '',
                        'title' => '',
                        'body' => '',
                        'created' => '',
                        'titleError' => '',
                        'bodyError' => ''];

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = ['user_id' => $_SESSION['user_id'],
                            'title' => trim($_POST['title']),
                            'body' => trim($_POST['body']),
                            'created' => date("Y-m-d H:i:s"),
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

                /* If everything is ok we can create the post */
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
                else
                {
                    $this->view('posts/create', $data);
                }
            }

            $this->view('posts/create', $data);
        }

        /* Function to modify an existing post */
        public function update($id)
        {
            $post = $this->postModel->findPostById($id);

            /* Only the post's original creator can modify the post and he/she have to be logged in */
            if(!isLoggedIn())
            {
                header("Location: " . URLROOT . "/posts");
            }
            elseif($post->userid != $_SESSION['user_id'])
            {
                header("Location: " . URLROOT . "/posts");
            }

            $data = ['id' => '',
                        'post' => $post,
                        'user_id' => '',
                        'title' => '',
                        'body' => '',
                        'modified' => '',
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
                            'modified' => date("Y-m-d H:i:s"),
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
    
                /* If everything is ok we can modify the post */
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
                else
                {
                    $this->view('posts/update', $data);
                }
            }
            
            $this->view('posts/update', $data);
        }

        /* Function to delete a post */
        public function delete($id)
        {
            $post = $this->postModel->findPostById($id);
    
            /* Only the post's original creator can delete a post and he/she have to be logged in */
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