<?php

class DB
{
    private static $pdo = null;

    public static function connect(array $config)
    {
        if (self::$pdo === null) {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
            try {
                self::$pdo = new PDO($dsn, $config['user'], $config['password']);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "DB 연결 성공!";
            } catch (PDOException $e) {
                die("DB 연결 실패: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function insert($sql, $params = [])
    {
        $stmt = self::$pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public static function update($sql, $params = [])
    {
        $stmt = self::$pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public static function delete($sql, $params = [])
    {
        $stmt = self::$pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public static function select($sql, $params = [])
    {
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function selectOne($sql, $params = [])
    {
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
