<?php
class Application
{
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var null Parameter one */
    private $url_parameter_1 = null;

    /** @var null Parameter two */
    private $url_parameter_2 = null;

    /** @var null Parameter three */
    private $url_parameter_3 = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->splitUrl();

        // check for controller: does such a controller exist ?
        if (file_exists('./application/controller/' . $this->url_controller . '.php')) {
            // if so, then load this file and create this controller
            // example: if controller would be "car", then this line would translate into: $this->car = new car();
            require './application/controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            // check for method: does such a method exist in the controller ?
            if (method_exists($this->url_controller, $this->url_action)) {

            	if (isset($this->url_parameter_5)) {
            		$this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3, $this->url_parameter_4, $this->url_parameter_5);
            	}elseif (isset($this->url_parameter_4)) {
            		$this->handleMethod($this->url_controller, $this->url_action, 4);
                    //$this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3, $this->url_parameter_4);
                }elseif (isset($this->url_parameter_3)) {
                	$this->handleMethod($this->url_controller, $this->url_action, 3);
                    // will translate to something like $this->home->method($param_1, $param_2, $param_3);
                    //$this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
                } elseif (isset($this->url_parameter_2)) {
                	$this->handleMethod($this->url_controller, $this->url_action, 2);
                    // will translate to something like $this->home->method($param_1, $param_2);
                    //$this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                } elseif (isset($this->url_parameter_1)) {
                    // will translate to something like $this->home->method($param_1);
                    //$this->url_controller->{$this->url_action}($this->url_parameter_1);
                    $this->handleMethod($this->url_controller, $this->url_action, 1);
                } else {
                    // if no parameters given, just call the method without parameters, like $this->home->method();
                    $this->handleMethod($this->url_controller, $this->url_action, 0);
                }
            } else {
                // default/fallback: call the index() method of a selected controller
                $this->url_controller->index();
            }
        } else {
            // invalid URL, so simply show home/index
            require './application/controller/home.php';
            $home = new Home();
            $home->index();
        }
    }
    
    function handleMethod($class, $action, $numUrlParams){
    	$reflector = new ReflectionClass($class);
    	$method=$reflector->getMethod($action);
    	
    	$numMethodParams = $method->getNumberOfParameters();
    	
    	if ($numUrlParams> $numMethodParams) $numUrlParams=$numMethodParams;
    	$passingParams=array();
    	for($i=0; $i<$numUrlParams; $i++){
            $paramName='url_parameter_' . ($i+1);
    		$passingParams[]= $this->$paramName;
    	}
    	for($i=0; $i<$numMethodParams - $numUrlParams; $i++){
    		$passingParams[]= null;
    	}

    	call_user_func_array(array($class, $action), $passingParams);
//     	call_user_method_array($action, $class, $passingParams);
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {

            // split URL
            $url = rtrim($_GET['url'], '/');
            //$url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Put URL parts into according properties
            // By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            $this->url_controller = (isset($url[0]) ? $url[0] : null);
            $this->url_action = (isset($url[1]) ? $url[1] : null);
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);
            $this->url_parameter_4 = (isset($url[5]) ? $url[5] : null);
            $this->url_parameter_5 = (isset($url[6]) ? $url[6] : null);

            // for debugging. uncomment this if you have problems with the URL
//             echo 'Controller: ' . $this->url_controller . '<br />';
//             echo 'Action: ' . $this->url_action . '<br />';
//             echo 'Parameter 1: ' . $this->url_parameter_1 . '<br />';
//             echo 'Parameter 2: ' . $this->url_parameter_2 . '<br />';
//             echo 'Parameter 3: ' . $this->url_parameter_3 . '<br />';

            
            
        }
    }
}