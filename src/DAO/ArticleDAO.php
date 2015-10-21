<?php

namespace Pipress\DAO;

use Pipress\Domain\Article;

class ArticleDAO extends DAO
{

    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "SELECT *, COUNT(co.id_commentaires) AS nbCommentaires
            FROM articles AS a
            INNER JOIN utilisateurs AS u 
            ON a.id_utilisateurs = u.id_utilisateurs
            LEFT JOIN categories AS c
            ON a.id_categories = c.id_categories
            LEFT JOIN commentaires AS co 
            ON a.id_articles = co.id_articles_commentaires
            WHERE a.status = 1
            GROUP BY a.id_articles
            ORDER BY a.id_articles DESC";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $articles = array();
        foreach ($result as $row) {
            $articlesId = $row['id_articles'];
            $articles[$articlesId] = $this->buildDomainObject($row);
        }
        return $articles;
    }

    /**
     * Return a list of all articles by category, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAllById($id) {
        $sql = "SELECT *, COUNT(co.id_commentaires) AS nbCommentaires
            FROM articles AS a
            INNER JOIN utilisateurs AS u 
            ON a.id_utilisateurs = u.id_utilisateurs
            LEFT JOIN categories AS c
            ON a.id_categories = c.id_categories
            LEFT JOIN commentaires AS co 
            ON a.id_articles = co.id_articles_commentaires
            WHERE a.status = 1
            AND a.id_categories = ?
            GROUP BY a.id_articles
            ORDER BY a.id_articles DESC";
        $result = $this->getDb()->fetchAll($sql, array($id));
        
        // Convert query result to an array of domain objects
        $articles = array();
        foreach ($result as $row) {
            $articlesId = $row['id_articles'];
            $articles[$articlesId] = $this->buildDomainObject($row);
        }
        return $articles;
    }

    /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Pipress\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "SELECT *, COUNT(co.id_commentaires) AS nbCommentaires
            FROM articles AS a
            INNER JOIN utilisateurs AS u 
            ON a.id_utilisateurs = u.id_utilisateurs
            LEFT JOIN categories AS c
            ON a.id_categories = c.id_categories
            LEFT JOIN commentaires AS co 
            ON a.id_articles = co.id_articles_commentaires
            WHERE a.id_articles = ?
            GROUP BY a.id_articles
            ";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No article matching id " . $id);
    }

    /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \Pipress\Domain\Article
     */
    protected function buildDomainObject($row) {
        $article = new Article();
        $article->setId($row['id_articles']);
        $article->setIdUser($row['id_utilisateurs']);
        $article->setIdCategory($row['id_categories']);
        $article->setTitle($row['titre']);
        $article->setContent($row['contenu']);
        $article->setStatut($row['status']);
        $article->setDate($row['date_articles']);
        $article->setPseudo($row['pseudo']);
        $article->setNameCategory($row['nom_categories']);
        $article->setNbComments($row['nbCommentaires']);
        return $article;
    }
}