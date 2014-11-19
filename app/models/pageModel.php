<?php
class pageModel
{
    private $db;
    private $table = 'page';
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function getList()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $outputArr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $outputArr;
    }
    
    public function getRow($id, $key = null)
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        if (isset($key)) {
            $keyEsc = $this->db->quote(trim(strip_tags($key)));
            $sql = "SELECT * FROM $this->table WHERE key = $keyEsc";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $outputArr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $outputArr;
    }
    
    public function add(array $fields, array $values)
    {
        $sql = "INSERT INTO $this->table (";
        foreach ($fields as $field) {
            $sql .= "$field, ";
        }
        $sql .= "lastUpdated, created".
                ") VALUES (";
        foreach ($values as $value) {
            $valueEsc = $this->db->quote(trim(strip_tags($value)));
            $sql .= $valueEsc.", ";
        }
        $sql .= "NOW(), NOW()".
                ")";
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }
    
    public function edit($id, array $fields, array $values)
    {
        $sql = "UPDATE $this->table SET ";
        foreach ($fields as $key => $field) {
            $valueEsc = $this->db->quote(trim(strip_tags($values[$key])));
            $sql .= "$field = $valueEsc, ";
        }
        $sql .= "lastUpdated = NOW() ".
                "WHERE id = $id";
        $this->db->exec($sql);
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = $id";
        $this->db->exec($sql);
    }
    
    public function getColumns()
    {
        $sql = "SHOW COLUMNS FROM $this->table";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $outputArr = $stmt->fetchAll();
        return $outputArr;
    }
    
    public function createTable()
    {
        $sql = "".
                'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";'.
                'SET time_zone = "+00:00";'.
                "CREATE TABLE IF NOT EXISTS `$this->table` (".
                "`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,".
                "`key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,".
                "`title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,".
                "`description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,".
                "`keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,".
                "`div` text COLLATE utf8_unicode_ci NOT NULL,".
                "`lastUpdated` datetime NOT NULL,".
                "`created` datetime NOT NULL,".
                "PRIMARY KEY (`id`)".
                ") ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;"
                ;
        $this->db->exec($sql);
    }
}
