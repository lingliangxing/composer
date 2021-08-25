<?php

return array (
  'autoload' => false,
  'hooks' => 
  array (
    'show_map' => 
    array (
      0 => '\\addons\\address\\Address',
    ),
    'markdown' => 
    array (
      0 => '\\addons\\editormd\\Editormd',
    ),
    'content_delete_end' => 
    array (
      0 => '\\app\\member\\behavior\\Hooks',
    ),
    'content_edit_end' => 
    array (
      0 => '\\app\\member\\behavior\\Hooks',
    ),
    'user_sidenav_after' => 
    array (
      0 => '\\app\\cms\\behavior\\Hooks',
      1 => '\\app\\pay\\behavior\\Hooks',
    ),
    'app_init' => 
    array (
      0 => '\\app\\cms\\behavior\\Hooks',
    ),
  ),
  'route' => 
  array (
  ),
);