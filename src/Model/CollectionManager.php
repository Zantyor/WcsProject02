<?php


namespace App\Model;

class CollectionManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'category';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $collection
     * @return int
     */
    public function insert(array $collection): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`title`) VALUES (:title)");
        $statement->bindValue('title', $collection['title'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $collection
     * @return bool
     */
    public function update(array $collection):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $collection['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $collection['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
