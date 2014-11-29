<?php
class dbTableModel
{
    private $db;
    private $table;
    
    public function __construct($db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }
    
    public function getList(array $fields = array(),
            $pageNo = '', $rowCount = '',
            $orderBy = '', $order = 'ASC',
            $q = '', $qIn = '')
    {
        $sql = "SELECT ";
        if (empty($fields)) {
            $sql .= "* ";
        } else {
            foreach ($fields as $field) {
                $sql .= "$field, ";
            }
            $sql = substr($sql, 0, -2)." ";
        }
        $sql .= "FROM $this->table ";
        if (strlen($q) > 0 && strlen($qIn) > 0) {
            $sql .= "WHERE $qIn LIKE '%$q%' ";
        }
        if (strlen($orderBy) > 0 && strlen($order) > 0) {
            $sql .= "ORDER BY $orderBy $order ";
        }
        if (strlen($pageNo) > 0 && strlen($rowCount) > 0) {
            $sql .= "LIMIT $pageNo, $rowCount";
        }
        
        return $this->output($sql);
    }
    
    public function getRow($whereKey, $whereValue, array $fields = array())
    {
        $whereValueEsc = $this->db->quote($whereValue);
        
        $sql = "SELECT ";
        if (empty($fields)) {
            $sql .= "* ";
        } else {
            foreach ($fields as $field) {
                $sql .= "$field, ";
            }
            $sql = substr($sql, 0, -2)." ";
        }
        $sql .= "FROM $this->table ".
                "WHERE $whereKey = $whereValueEsc";
        
        return $this->output($sql);
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
            $valueEsc = $this->db->quote($value);
            $sql .= $valueEsc.", ";
        }
        $sql .= "NOW(), NOW()".
                ")";
        
        $this->db->exec($sql);
        
        return $this->db->lastInsertId();
    }
    
    public function edit($whereKey, $whereValue,
            array $fields, array $values)
    {
        $whereValueEsc = $this->db->quote($whereValue);
        
        $sql = "UPDATE $this->table SET ";
        foreach ($fields as $key => $field) {
            $valueEsc = $this->db->quote($values[$key]);
            $sql .= "$field = $valueEsc, ";
        }
        $sql .= "lastUpdated = NOW() ".
                "WHERE $whereKey = $whereValueEsc";
        
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
        
        return $this->output($sql);
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
    
    private function output($sql)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $outputArr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $outputArr;
    }
}
