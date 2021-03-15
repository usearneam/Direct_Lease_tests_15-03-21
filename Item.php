<?php

class Item
{
    private int $id;
    private string $name;
    private int $status;
    private bool $changed;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->init($id);
    }

    /**
     * Get the 'name' and 'status' from the 'objects' table
     * 
     * @param int $id
     * 
     * @return void
     */
    private function init(int $id)
    {
        // "представим что класс уже работает с бд"
        $connection = new PDO();

        $sql = 'SELECT name, status
            FROM objects
            WHERE id = ?;';
        $params = [$id];

        $statement = $connection->prepare($sql);
        $statement->execute($params);
        $resp = $statement->fetch(PDO::FETCH_ASSOC);

        $this->name = $resp['name'];
        $this->status = $resp['status'];
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set(string $name, $value)
    {
        if ($name === 'id') throw new Exception('"id" cannot be overwritten');

        if (empty($value)) throw new Exception("\"$name\" cannot be empty");

        $rp = new ReflectionProperty(self::class, $name);
        $type = $rp->getType()->getName();
        $is_val = 'is_' . $type;

        if (!$is_val($value)) throw new Exception("\"$name\" must be $type");

        $this->$name = $value;
        $this->changed = true;
    }

    /**
     * Save changes
     * 
     * @return bool TRUE on success or FALSE on failure.
     */
    public function save()
    {
        // "представим что класс уже работает с бд"
        $connection = new PDO();

        if (isset($this->changed)) {
            $sql = 'UPDATE objects
            SET name = :name, status = :status
            WHERE id = :id;';

            $params = [
                'id' => $this->id,
                'name' => $this->name,
                'status' => $this->status,
            ];

            $statement = $connection->prepare($sql);
            $statement->execute($params);

            return true;
        }
        return false;
    }
}
