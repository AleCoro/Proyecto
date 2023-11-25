<?php
session_start();

$respuesta = array('session_exists' => isset($_SESSION["id_usuario"]));

echo json_encode($respuesta);