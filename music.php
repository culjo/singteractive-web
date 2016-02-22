<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 1/8/2016
 * Time: 4:50 PM
 *
 * 1 - get the get parameters
 */
require 'include/music_functions.php';

$music_func = new MusicFunctions();

var_dump($music_func->get_all_music());

?>