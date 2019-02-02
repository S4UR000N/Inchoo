<?php

// routes
return array(
    ""                              => "HomeController:home",
    "/"                             => "HomeController:home",

    "/register"                     => "UserController:register",
    "/register/"                    => "UserController:register",

    "/login"                        => "UserController:login",
    "/login/"                       => "UserController:login",

    "/test"                         => "TestController:test",
    "/test/"                        => "TestController:test"
);
