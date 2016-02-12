<?php

/**
 * The file acts like an API for functions that may be called repeatedly.
 *
 * This file lists various functions and their implementation that may be
 * used throughout ARIA. Simply require_once() this file and the all of the
 * associated functionality will be available.
 *
 * @link       http://wesleykepke.github.io/ARIA/
 * @since      1.0.0
 *
 * @package    ARIA
 * @subpackage ARIA/includes
 */

 $

if (!session_id()) {
	session_start();
}

$nnmta_music_db_id = $_SESSION['music_db_id'];
