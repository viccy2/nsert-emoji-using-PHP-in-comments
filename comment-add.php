<?php
require_once ("db.php");
$commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : "";
$comment = isset($_POST['comment']) ? $_POST['comment'] : "";
$commentSenderName = isset($_POST['name']) ? $_POST['name'] : "";
$date = date('Y-m-d H:i:s');

$query = "INSERT INTO tbl_comment(parent_comment_id,comment,comment_sender_name,date) VALUES (?,?,?,?)";

$sql_stmt = $conn->prepare($query);

$param_type = "dsss";
$param_value_array = array(
    $commentId,
    $comment,
    $commentSenderName,
    $date
);
$param_value_reference[] = & $param_type;
for ($i = 0; $i < count($param_value_array); $i ++) {
    $param_value_reference[] = & $param_value_array[$i];
}
call_user_func_array(array(
    $sql_stmt,
    'bind_param'
), $param_value_reference);

$sql_stmt->execute();
?>
