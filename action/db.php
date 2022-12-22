<?php
// error_reporting(0);
$host = '82.157.0.138';
$user = 'ctf';
$pass_word = '123456';
$database = 'ctf';
$port = '3306';

// 设置全局数据库连接变量
$db = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database . ';', $user, $pass_word);

///**
// * 获取数据库连接
// * @return PDO|null 返回数据库连接
// */
//function get_global_db_pdo()
//{
//    global $db;
//
//    // 若连接未建立
//    if ($db === null) {
//
//        // 建立数据库连接
//        $db = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database . ';', $user, $pass_word);
//
////        // 设置连接属性
////        // 禁用预处理语句的模拟,使用本地预处理语句
////        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
//
//    }
//
//    // 返回数据库连接
//    return $db;
//}

/**
 * 进行数据库插入操作
 * @param $table 将要插入的表
 * @param array $fields 将要插入的数据（以数组的形式传参）
 * @return string|void 最后插入行的ID或序列值
 */
function db_insert($table, array $fields)
{
    // 获取数据库连接
    // $db = get_global_db_pdo();
    global $db;

    // 拼接SQL语句，implode用于将一维数组转换为字符串
    // 形如 INSERT INTO $table ($fields的键名) VALUES (?,?,?,...)
    $sql = 'INSERT INTO ' . $table . ' (';
    $sql .= implode(', ', array_keys($fields));
    $sql .= ') VALUES (';
    $sql .= implode(', ', array_fill(0, count($fields), '?'));
    $sql .= ')';

    // 准备要执行的语句
    $stmt = $db->prepare($sql);

    // 调用null_to_bool方法将空值转化为0
    array_walk($fields, 'null_to_bool');

    // 获得数组值
    $values = array_values($fields);

    // 执行SQL语句
    $stmt->execute($values);

    // 返回最后插入行的ID或序列值
    return $db->lastInsertId();

}

/**
 * 进行数据库更新操作
 * @param $table 将要更新的表
 * @param array $fields 将要更新的数据（以数组的形式传输）
 * @param array $where 将要更新的数据的where限定条件（以数组的形式传输）
 * @param string $whereGlue 用于连接where语句的单词，默认为AND
 * @return int|void 受上一个SQL语句影响的行数
 */
function db_update($table, array $fields, array $where, $whereGlue = 'AND')
{
    // 获取数据库连接
    // $db = get_global_db_pdo();
    global $db;


    // 拼接SQL语句
    // 形如 UPDATE $table SET $fields的键名1=?, $field的键名2=? WHERE $where的键名1=? AND $where的键名2=?
    $sql = 'UPDATE ' . $table . ' SET ';
    $sql .= implode('=?, ', array_keys($fields)) . '=? ';
    $sql .= 'WHERE ' . implode('=? ' . $whereGlue . ' ', array_keys($where)) . '=?';

    // 准备要执行的语句
    $stmt = $db->prepare($sql);

    // 调用null_to_bool方法将空值转化为0
    array_walk($fields, 'null_to_bool');

    // 获得数组值并将其合并到新数组
    $values = array_merge(array_values($fields), array_values($where));

    // 执行SQL语句
    $stmt->execute($values);

    // 返回受上一个SQL语句影响的行数
    return $stmt->rowCount();


}

/**
 * 进行数据库删除操作
 * @param $table 待删除的表
 * @param array $where 将要更新的数据的where限定条件（以数组的形式传输）
 * @param string $whereGlue 用于连接where语句的单词，默认为AND
 * @return int|void 受上一个SQL语句影响的行数
 */
function db_delete($table, array $where, $whereGlue = 'AND')
{
    // 获取数据库连接
    // $db = get_global_db_pdo();
    global $db;


    // 拼接SQL语句
    // 形如 DELETE FROM $table WHERE $where的键名1=? AND $where的键名2=?
    $sql = 'DELETE FROM ' . $table . ' ';
    $sql .= 'WHERE ' . implode('=? ' . $whereGlue . ' ', array_keys($where)) . '=?';

    // 准备要执行的语句
    $stmt = $db->prepare($sql);

    // 获取数组值
    $values = array_values($where);

    // 执行SQL语句
    $stmt->execute($values);

    // 返回受上一个SQL语句影响的行数
    return $stmt->rowCount();


}

/**
 * 查询表中记录条数
 * @param $table 待查询表
 * @param array|null $where 限定条件
 * @param string $whereGlue where的连接单词,默认为AND
 * @return mixed 返回记录条数
 */
function db_count_num($table, array $where = null, $whereGlue = 'AND')
{
    $count = db_select_one($table, array('COUNT(*) AS num'), $where, null, $whereGlue);
    return $count['num'];
}

/**
 * 查询单条记录
 */
function db_select_one($table, array $fields, array $where = null, $orderBy = null, $whereGlue = 'AND')
{
    return db_select($table, $fields, $where, $orderBy, $whereGlue, false);
}

/**
 * 查询所有记录
 */
function db_select_all($table, array $fields, array $where = null, $orderBy = null, $whereGlue = 'AND')
{
    return db_select($table, $fields, $where, $orderBy, $whereGlue, true);
}

/**
 * 查询表中数据
 * @param $table 将要查询的表
 * @param array $fields 将要查询的数据
 * @param array|null $where 限定条件，默认为null
 * @param null $orderBy 限定条件，默认为null
 * @param string $whereGlue 用于连接where语句的单词，默认为null
 * @param bool $all 判断是否查询所有，默认为true
 * @return array|mixed|void 返回查询结果
 */
function db_select($table, array $fields, array $where = null, $orderBy = null, $whereGlue = 'AND', $all = true)
{
    // 获取数据库连接
    // $db = get_global_db_pdo();
    global $db;

    // 拼接查询语句
    // 形如 SELECT $fields[0] , $fields[1] FROM $table
    $query = 'SELECT ' . implode(', ', $fields) . ' ';
    $query .= 'FROM ' . $table . ' ';

    // 若$where不为空
    if (!empty($where)) {
        // 拼接查询语句
        $query .= 'WHERE ' . implode('=? ' . $whereGlue . ' ', array_keys($where)) . '=?';
    }

    // 若$orderBy不为空
    if (!empty($orderBy)) {
        //拼接查询语句
        $query .= ' ORDER BY ' . $orderBy;
    }

    // 若$where不为空
    if (!empty($where)) {
        // 准备要执行的语句
        $stmt = $db->prepare($query);

        // 获取数组值
        $values = array_values($where);

        // 执行语句
        $stmt->execute($values);
    } else {
        // 执行语句
        $stmt = $db->query($query);
    }

    // 若限定查询所有记录
    if ($all) {
        // 返回一个包含结果集中所有行的数组
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // 从结果集中取下一行
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

/**
 * 查询单独
 */
function db_query_fetch_one($query, array $values = null)
{
    return db_query($query, $values, false);
}

/**
 * 查询所有
 */
function db_query_fetch_all($query, array $values = null)
{
    return db_query($query, $values, true);
}

/**
 * 存在疑问
 * 查询但不返回任何值
 */
function db_query_fetch_none($query, array $values = null)
{
    db_query($query, $values, null);
}

/**
 * 用于数据库查询
 * @param $query 查询语句
 * @param array|null $values 查询语句的预处理值
 * @param bool $all 是否查询所有,默认为true
 * @return array|mixed|void 返回查询结果
 */
function db_query($query, array $values = null, $all = true)
{
    // 获取数据库连接
    // $db = get_global_db_pdo();
    global $db;


    // 查询数据库
    if (!empty($values)) {
        $stmt = $db->prepare($query);
        $stmt->execute($values);
    } else {
        $stmt = $db->query($query);
    }

    // 判定是否查询所有
    if ($all === true) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else if ($all === false) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}

/**
 * 启动一个事务
 */
function db_begin_transaction()
{
    // 获取数据库连接并启动一个事务
    // $db = get_global_db_pdo();
    global $db;
    $db->beginTransaction();
}

/**
 * 提交并停止一个事务
 */
function db_end_transaction()
{
    // 获取数据库连接并提交事务
    // $db = get_global_db_pdo();
    global $db;
    $db->commit();
}

/**
 * 回滚一个事务
 */
function db_rollback_transaction()
{
    // 获取数据库连接并回滚一个事务
    // $db = get_global_db_pdo();
    global $db;
    $db->rollBack();
}

/**
 * 将空值转化为0
 */
function null_to_bool(&$val)
{
    if (!isset($val)) {
        $val = 0;
    }
}