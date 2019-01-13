<?php

// routes
return array(
    ""                              => "FrontController:home",
    "/"                             => "FrontController:home",

    "/User/Register"                => "UserController:register",
    "/User/Register/"               => "UserController:register",

    "/test"                         => "testController:test"
);
