<?php
/**
 * Created by PhpStorm.
 * User: garrettblakeman
 * Date: 12/29/14
 */

require_once('./includes.php');
array_filter($_POST, 'trimPosts');
$errors         = array();  	// array to hold validation errors
$data 			= array(); 		// array to pass back data
/** Validate Input */
	// TODO-me actually validate all data not just check for existance
    if (empty($_POST['colorDrop1']))
    $errors['colorDrop1'] = 'First color selection is required.';
    if (empty($_POST['colorDrop2']))
    $errors['colorDrop2'] = 'Second color selection is required.';
    if (empty($_POST['name']))
        $errors['name'] = 'Name is required.';
// return a response ===========================================================
	// if there are any errors in our errors array, return a success boolean of false
	if ( ! empty($errors)) {
        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
        /** Get new favorite color */
        //we'll pretend the sum of two color ids is enough to find a favorite color
        $hex1 = lettersNumbersOnly($_POST['colorDrop1']);
        $hex2 = lettersNumbersOnly($_POST['colorDrop2']);
        $colorNew = new colorSelect($hex1, $hex2, 'name');
        $colorNewHex = new colorSelect($hex1, $hex2, 'hex');
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

        //save selections
        incrementColor($hex1);
        incrementColor($hex2);

        //Save information to the session
        $_SESSION['name'] = $name;
        $_SESSION['hex1'] = $hex1;
        $_SESSION['hex2'] = $hex2;
        $_SESSION['newColor'] = $colorNewHex->color;

        // pass success, message and color
        $data['success'] = true;
        $data['message'] = 'Thanks ' . $name . '! Perhaps you would like ' . $colorNew->color . '?';
        $data['newColor'] = $colorNewHex->color;
    }
	// return all our data to an AJAX call
	echo json_encode($data);
