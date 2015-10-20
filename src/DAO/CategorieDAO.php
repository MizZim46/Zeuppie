<?php

namespace Pipress\DAO;

use Doctrine\DBAL\Connection;
use Pipress\Domain\Categorie;

class CategorieDAO extends DAO
{

    /**
     * Return a list of all categories, sorted by date (most recent first).
     *
     * @return array A list of all categories.
     */
    public function findAll() {
        $sql = "SELECT *
            FROM categories";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $categories = array();
        foreach ($result as $row) {
            $categoriesId = $row['id_categories'];
            $categories[$categoriesId] = $this->buildDomainObject($row);
        }
        return $categories;
    }


    /**
     * Return a list of all categories, sorted by date (most recent first).
     *
     * @return array A list of all categories.
     */
    public function find($id) {
        $sql = "SELECT *
            FROM categories
            WHERE id_categories = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
    }

    /**
     * Creates an Categorie object based on a DB row.
     *
     * @param array $row The DB row containing Categorie data.
     * @return \Pipress\Domain\Categorie
     */
    protected function buildDomainObject($row) {
        $categorie = new Categorie();
        $categorie->setId($row['id_categories']);
        $categorie->setName($row['nom_categories']);
        $categorie->setStatut($row['status']);
        return $categorie;
    }
}