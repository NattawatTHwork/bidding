<?php
session_start();
require_once '../../connect/connect.php';

if (isset($_SESSION['admin_id'])) {

    $building_id = $_POST['building_id'];
    $room_name = $_POST['room_name'];
    $status = $_POST['status'];

    $insert_room = $connect->prepare("INSERT INTO rooms(building_id, room_name, status) VALUES(:building_id, :room_name, :status)");
    $insert_room->bindParam(":building_id", $building_id);
    $insert_room->bindParam(":room_name", $room_name);
    $insert_room->bindParam(":status", $status);
    $insert_room->execute();
    if ($insert_room) {
        echo 'success';
        exit();
    } else {
        echo 'fail';
        exit();
    }
} else {
    header("location: ../../login.php");
}
