<?php
/**
 * 群组中用户列表 - 根据 群组id 获得群组中的成员
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
require("./connectMySQL.php");

$pageSize = 10;
$pageNum = 1;
$pageTotal = 0; // 总页数

/**
 * 分页的函数 */
function newPaging($pageNum, $pageSize, $groupId)
{
  global $conn;

  $array = array();
  $sql = "select * from userofgroup where groupId='$groupId' limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
  $check_query = mysqli_query($conn , $sql);
  if (!$check_query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
  }
  while ($obj = mysqli_fetch_object($check_query)) {
    $array[] = $obj;
  }
  return $array;
}

if(isset($_GET['pageSize'])){
  $pageSize = $_GET['pageSize'];
}
if(isset($_GET['pageNum'])){
  $pageNum = $_GET['pageNum'];
}
if(!isset($_GET['groupId'])){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 请选择相关群组!"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

//显示出总页数
$groupId = $_GET['groupId'];
$sql2 = "select count(*) num from userofgroup where groupId='$groupId'";  // 返回表的纪录数
$check_query2 = mysqli_query($conn, $sql2);
$obj = mysqli_fetch_object($check_query2);
$pageTotal = $obj->num;

$result = newPaging($pageNum, $pageSize, $groupId);
if($result || gettype($result)==='array'){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=>array(
      'dataSize' => $pageSize,
      'dataNum' => $pageNum,
      'dataTotal' => $pageTotal,
      'dataList' => newPaging($pageNum, $pageSize, $groupId)
    ),
    'resInfo'=>'成功: 获取数据成功!'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}else{
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：数据获取失败, 请稍后重试或联系管理员!'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}
