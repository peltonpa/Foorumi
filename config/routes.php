<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/etusivu', function() {
    AlueController::index();
});

$routes->get('/keskustelualue', function() {
    HelloWorldController::keskustelualue();
});

$routes->get('/ketju', function() {
    HelloWorldController::ketju();
});

$routes->get('/kirjautuminen', function() {
HelloWorldController::kirjautuminen();
});

