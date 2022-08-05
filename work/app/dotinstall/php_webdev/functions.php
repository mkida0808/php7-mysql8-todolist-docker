<?php
session_start();

function h($str)
{
  return htmlspecialchars($str);
}

function createToken()
{
  if (!isset($_SESSION['token']))
  {
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }
}

function validateToken()
{
  if (empty($_SESSION['token']) || $_SESSION['token'] !== filter_input(INPUT_POST, 'token'))
  {
    exit('Invalid post request');
  }
}

session_start();