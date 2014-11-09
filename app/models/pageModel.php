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
}
