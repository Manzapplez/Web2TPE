<?php
session_start();

require_once 'app/routes/Router.php';
// Crea la instancia del Router
$router = new Router();
// Evalúa la acción solicitada por el usuario y llama al método correspondiente
$router->evaluateAction();



//dar lista dse artistas total y cargarlo en el select
// lo mismo con listas de canciones
//lo mismo con usuarios