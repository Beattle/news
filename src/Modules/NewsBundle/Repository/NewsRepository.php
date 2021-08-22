<?php

namespace App\Modules\NewsBundle\Repository;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Driver\Exception;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class NewsRepository
{
    const DEFAULT_PAGE = 1;
    const DEFAULT_LIMIT = 25;
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var AdapterInterface
     */
    private $cache;

    public function __construct(Connection $connection, AdapterInterface $cache)
    {
        $this->connection = $connection;
        $this->cache = $cache;
    }

    /**
     * @throws Exception
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getByID($id)
    {

        $cacheKey = $this->getCashKey('item_news_', $id);
        $item = $this->cache->getItem($cacheKey);
        if (!$item->isHit()) {
            $sql = "SELECT * FROM news WHERE id = :name";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue("id", $id);
            $resultSet = $stmt->execute()->fetchOne();
            if (!$resultSet) {
                return false;
            }
            $item->set($resultSet);
            $this->cache->save($item);

        }

        return $item->get();

    }

    public function getCollection(
        $filter,
        $order,
        $num = self::DEFAULT_LIMIT,
        $page = self::DEFAULT_PAGE): array
    {

        // Получаем коллекцию статей с возможностью фильтрации, постраничным разбиением и т.д.

        return $collection = [];
    }

    public function update($id, $data): bool
    {
        // удаляем кэш и изменяем статью.
        $cacheKey = $this->getCashKey('item_news_', $id);
        $this->cache->deleteItem($cacheKey);

        $sql = '';


        return true;
    }


    private function getCashKey($prefix, $param)
    {
        return $cacheKey = hash('sha1', $prefix . $param);
    }

    public function delete($id)
    {
        // удаление сущности новости
        return true;
    }

    public function create($data)
    {
        // создание сущности новости в таблице news_post + создание текста в таблице post_body
        return 1;
    }
}