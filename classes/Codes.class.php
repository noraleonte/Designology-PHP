<?php
class Codes extends Dbh
{
    public function setCode($id, $code)
    {
        $sql = "INSERT INTO confirmation_codes(code,user_id)  VALUES (?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$code, $id])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function validateCode($code)
    {
        $sql = "SELECT * FROM confirmation_codes WHERE code=(?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);
        $codes = $stmt->fetch();
        if ($codes) {
            return $codes['user_id'];
        } else {
            return 0;
        }
    }
}
