<?php

// routes
return array(
    ""                              => "HomeController:home",
    "/"                             => "HomeController:home",

    "/User/Register"                => "UserController:register",
    "/User/Register/"               => "UserController:register",

    "/test"                         => "testController:test"
);
