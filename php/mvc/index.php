<html>
<head>
    <title>Hello World!</title>
    
</head>
<body>
Hello World!<br>
    <?php

class Model
{
    public $string;
 
    public function __construct(){
        $this->string = "MVC + PHP = Awesome, click here!";
    }
 
}

class View
{
    private $model;
    private $controller;
 
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }
 
    public function output() {
        return '<p><a href="index.php?action=clicked">' . $this->model->string . "</a></p>";
    }
}
class Controller
{
    private $model;
 
    public function __construct($model){
        $this->model = $model;
    }
 
    public function clicked() {
        $this->model->string = "Updated Data, thanks to MVC and PHP!";
    }
}
echo "1<br>"; 
$model = new Model();
echo "2<br>"; 
$controller = new Controller($model);
echo "3<br>"; 
$view = new View($controller, $model);
echo "4<br>";
if (isset($_GET['action']) && !empty($_GET['action'])) {
    $controller=$controller->{$_GET['action']}();
}
echo "here<br>"; 
echo $view->output();
echo "there<br>"; 
?>
EOF
</body>
</html>
