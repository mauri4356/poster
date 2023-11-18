<?php
function dbQuery($sql, $params = [])
{
    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}

function dbRow($sql, $params = [])
{
    $stmt = dbQuery($sql, $params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function dbColumn($sql, $params = [])
{
    $stmt = dbQuery($sql, $params);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function dbInsert($table, $data)
{
    global $db;
    $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
        $table,
        implode(', ', array_keys($data)),
        implode(', ', array_fill(0, count($data), '?'))
    );
    $stmt = $db->prepare($sql);
    $stmt->execute(array_values($data));
    return $db->lastInsertId();
}

function dbUpdate($table, $data, $where)
{
    global $db;
    $sql = sprintf("UPDATE %s SET %s WHERE %s",
        $table,
        implode(', ', array_map(function ($key) { return "$key = ?"; }, array_keys($data))),
        $where
    );
    $stmt = $db->prepare($sql);
    $stmt->execute(array_values($data));
    return $stmt->rowCount();
}

function dbDelete($table, $where)
{
    global $db;
    $sql = sprintf("DELETE FROM %s WHERE %s", $table, $where);
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}