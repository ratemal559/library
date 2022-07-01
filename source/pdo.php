<?php
Class pd
{
    private static $link;

    public function connect()
    {
        if(!isset($this->link))
        {
            // $options = [
            //     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            //     PDO::ATTR_EMULATE_PREPARES   => false,
            // ];
            $host = 'localhost';
            $dsn = "mysql:host='localhost';dbname='Library';charset='utf8mb4'";
            try 
            {
                self::$link = new PDO('mysql:host=localhost;dbname=Library;charset=utf8mb4', 'root', 'FT58S7hH55Vbnkv');
            } catch (\PDOException $e) {
                    echo $e->getMessage();
            }
        }
    }

    //bez podmínky vrátí celou tabulku
    public function select_all($table, $condition = null)
    {
        // $stmt = self::$link->query("SELECT * FROM Book");
        try
        {
            if($condition == null)
            {
                $data = self::$link->query("SELECT * FROM {$table}")->fetchAll();
                
            }
            else
            {
                $data = self::$link->query("SELECT * FROM {$table} WHERE {$condition}")->fetchAll();
                // $data = self::$link->query("SELECT * FROM {$table} WHERE Genre='Novel'")->fetchAll();
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $data;
        // $data = $stmt->fetch();
        // echo $data;
    }

    public function select_first($table, $condition = null)
    {
        try
        {
            if($condition == null)
            {
                $data = self::$link->query("SELECT * FROM {$table}")->fetch();
                
            }
            else
            {
                $data = self::$link->query("SELECT * FROM {$table} WHERE {$condition}")->fetch();
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $data;
    }

    public function count_matches($table, $condition = null)
    {
        $i=0;
        try
        {
            if($condition == null)
            {
                $stmt = self::$link->query("SELECT * FROM {$table}");
                
            }
            else
            {
                $stmt = self::$link->query("SELECT * FROM {$table} WHERE {$condition}");
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        while($stmt->fetch())
        {
            $i++;
        }
        return $i;
    }

    //bez specifikace vrátí první sloupec
    public function select_column($table, $column = null, $condition = null)
    {
        try
        {
            if ($column == null)
            {
                if($condition == null)
                {
                    $data = self::$link->query("SELECT ID FROM {$table}")->fetchall();
                    
                }
                else
                {
                    $data = self::$link->query("SELECT ID FROM {$table} WHERE {$condition}")->fetchall();
                }
            }
            else
            {
                if($condition == null)
                {
                    $data = self::$link->query("SELECT {$column} FROM {$table}")->fetchall();
                    
                }
                else
                {
                    $data = self::$link->query("SELECT {$column} FROM {$table} WHERE {$condition}")->fetchall();
                }
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $data;
    }

    public function select_column_first($table, $column = null, $condition = null)
    {
        try
        {
            if ($column == null)
            {
                if($condition == null)
                {
                    $data = self::$link->query("SELECT ID FROM {$table}")->fetch();
                    
                }
                else
                {
                    $data = self::$link->query("SELECT ID FROM {$table} WHERE {$condition}")->fetch();
                }
            }
            else
            {
                if($condition == null)
                {
                    $data = self::$link->query("SELECT {$column} FROM {$table}")->fetch();
                    
                }
                else
                {
                    $data = self::$link->query("SELECT {$column} FROM {$table} WHERE {$condition}")->fetch();
                }
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $data;
    }

    public function add_row($table, $columns, $values)
    {
        try
        {
            self::$link->exec("INSERT INTO {$table} ({$columns}) VALUES ({$values})");
            // self::$link->query("INSERT INTO Book (Name) values(?)")->execute('blank');
            // echo "here";
            // self::$link->exec("INSERT INTO Book (Name,Genre) VALUES (blank,Novel)");
        } catch (\PDOException $e) {
            echo $e->getMessage();
            // echo "ERROR";
        }
        // echo "here2";
    }

    public function update($table, $value, $condition)
    {
        try
        {
            self::$link->exec("UPDATE {$table} SET {$value} WHERE{$condition}");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }   
    }

    public function remove_row($table, $condition)
    {
        try
        {
            self::$link->exec("DELETE FROM {$table} WHERE{$condition}");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}


?>