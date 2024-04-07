<?php
require_once 'C:\xampp\htdocs\SAS\config.php';

/* insert function start*/
function insert($table, $data)
{
	global $conn;
	$keys = array_keys($data);
	$columns = implode(', ', $keys);
	$values = implode("', '", $data);
	$sql = "INSERT INTO " . $table . "(" . $columns . ") VALUES ('" . $values . "')";
	/*		print_r($sql);
exit();*/
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$msg = array(
			'status' => true,
			'msg' => 'record added successfully',
		);
	} else {
		$msg = array(
			'status' => false,
			'msg' => 'Connection failed: ' . mysqli_error($conn),
		);
	}
	return $msg;
}
/* insert function end */


/* update function start*/
function update($table, $data, $where)
{
	global $conn;
	$update_data = [];
	foreach ($data as $columns => $value) {
		$update_data[] = $columns . '="' . $value . '"';
	}
	$update_data = implode(',', $update_data);
	$sql = 'UPDATE ' . $table . ' SET ' . $update_data . ' WHERE ' . $where;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$msg = array(
			'status' => true,
			'msg' => 'record updateded successfully',
		);
	} else {
		$msg = array(
			'status' => false,
			'msg' => 'Connection failed: ' . mysqli_error($conn),
		);
	}
	return $msg;
}
/* update function end*/



/* delete function start*/
function delete($table, $where)
{
	global $conn;
	$sql = "DELETE FROM $table WHERE " . $where;
	/*	print_r($sql);
	exit();*/
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$msg = array(
			'status' => true,
			'msg' => 'record deleted successfully',
		);
	} else {
		$msg = array(
			'status' => false,
			'msg' => 'Connection failed: ' . mysqli_error($conn),
		);
	}
	return $msg;
}
/* delete function end*/


/* select function start*/
function select($table, $columns = '*', $where = NULL, $order_by = NULL, $limit = NULL, $offset = NULL)
{
	global $conn;
	$sql = "SELECT  $columns FROM  " . $table;
	if ($where !== NULL) {
		$sql .= ' WHERE ' . $where;
	}
	if ($order_by !== NULL) {
		$sql .= ' ORDER BY ' . $order_by;
	}
	if ($limit !== NULL) {
		$sql .= ' LIMIT ' . $limit;
	}
	if ($offset !== NULL) {
		$sql .= ' OFFSET ' . $offset;
	}
	// print_r($sql);
	// 	exit();
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $data;
	} else {
		$msg = array(
			'status' => false,
			'msg' => 'Connection failed: ' . mysqli_error($conn),
		);
	}
	return $msg;
}
/* select function end*/



function query($q)
{
	global $conn;
	// print_r($q);
	// 	exit();
	$result = mysqli_query($conn, $q);
	if ($result) {
		$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $data;
	} else {
		$msg = array(
			'status' => false,
			'msg' => 'Connection failed: ' . mysqli_error($conn),
		);
	}
	return true;
}
