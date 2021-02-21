<?php


namespace testtask\Models;

use testtask\Services\Db;
//use Model\Article;

abstract class ActiveRecordEntity implements \JsonSerializable
{
    /** @var int */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    //Проверка на поторение записи бд
    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
            [':value' => $value],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result[0];
    }


    /**
     * @param int $id
     * @return static|null
     */
    public static function getById(int $id): ?self
    {
        $db = Db::getinstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }

        return $mappedProperties;
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }


    /**
     * @return static[]
     */
    public static function getAll(): array
    {
        $db = DB::getinstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    public function save()
    {
//        $db = DB::getinstance();
//        return $db->query('UPDATE `' . static::getTableName() . '` SET ' . $name . '=:value;', ['value' => $value], static::class);
        $mappedProperties = $this->mapPropertiesToDbFormat();
//        var_dump($this->id);
//        var_dump($mappedProperties);
        if($this->id !== null){
            $this->update($mappedProperties);
        }else{
            $this->insert($mappedProperties);
        }

    }

    private function update(array $mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index; // :param1
            $columns2params[] = $column . ' = ' . $param; // column1 = :param1
            $params2values[':param' . $index] = $value; // [:param1 => value1]
            $index++;
        }
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    private function insert(array $mappedProperties): void
    {
        //здесь мы создаём новую запись в базе
        $filteredProperties = array_filter($mappedProperties);

        $columns = [];
        $paramsNames = [];
//        var_dump($filteredProperties);
        foreach ($filteredProperties as $columnName => $value) {
            $columns[] = '`' . $columnName. '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';

        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);

        $this->id = $db->getLastInsertId();
        $lastRecord = static::getById($this->id);
        $this->createdAt = $lastRecord->createdAt;
    }

    public function delete()
    {
        $db = Db::getInstance();
        $sql = "DELETE FROM " . static::getTableName() . " WHERE id = :id";
        $params = ['id' => $this->id];
        $db->query($sql, $params, static::class);
        $this->id = null;
    }

    public function jsonSerialize()
    {
        return $this->mapPropertiesToDbFormat();
    }

    abstract protected static function getTableName(): string;
}