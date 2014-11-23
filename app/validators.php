<?php

Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^[\pL\s]+$/u', $value);
});
Validator::extend('hex', function($attribute, $value, $parameters)
{
  if(preg_match("/^#?([a-f0-9]{6}|[a-f0-9]{3})$/", $value))
  {
    return true;
  }
   
  return false;
});