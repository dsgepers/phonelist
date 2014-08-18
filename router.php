<?php
use \Studievolg\Router as Router;
use \Studievolg\View as View; 
/**
 * This File contains all routes.
 * The routes first param make use of regular expression.
 * 
 * (\d+) stands for any digit [0-9]
 * (\w+) stands for any word [A-Za-z0-9_]
 * (.*?) stands for ANYTHING
 * 
 * Any regex part is added as a function parameter, in the same order as defined.
 */

Router::route('', function() {
            $controller = new \Studievolg\Controller\BaseController;
            $controller->authenticate();
        });


//Catch any other route, and forward to 404
Router::route('(.*)', function() {
            header("Location: /404");
        });