<?php

// routes
return array(
    ""                              => "HomeController:home",
    "/"                             => "HomeController:home",

    "/register"                     => "UserController:register",
    "/register/"                    => "UserController:register",

    "/login"                        => "UserController:login",
    "/login/"                       => "UserController:login",

    "/logout"                       => "LogoutController:logout",
    "/logout/"                      => "LogoutController:logout",

    "/management"                   => "ManagementController:management",
    "/management/"                  => "ManagementController:management"
);
