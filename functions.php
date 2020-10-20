<?php

/**
 *  Gets a new mysql connection
 */
function getConnection() {
  $connection = new mysqli('localhost:3306', 'root', '', 'web2');
  if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $connection->connect_error);
    die;
  }
  return $connection;
}

/**
 * Inserts a new student to the database
 *
 * @student An associative array with the student information
 */
function saveUser($user) {
  $conn = getConnection();
  $sql = "INSERT INTO users( `name`,`seconName` ,`password`, `role`) VALUES ('{$user['name']}', '{$user['secondName']}' ,'{$user['password']}', 'Cliente')";
  $conn->query($sql);

  if ($conn->connect_errno) {
    $conn->close();
    return false;
  }
  $conn->close();
  return true;
}


/**
 * Get all students from the database
 *
 */


/**
 * Get one specific student from the database
 *
 * @id Id of the student
 */
function authenticate($username, $password){
  $conn = getConnection();
  $sql = "SELECT * FROM users WHERE `name` = '$username' AND `password` = '$password'";
  $result = $conn->query($sql);

  if ($conn->connect_errno) {
    $conn->close();
    return false;
  }
  $conn->close();
  return $result->fetch_array();
}

/**
 * Deletes an student from the database
 */
