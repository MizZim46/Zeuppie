<?php

namespace Pipress\DAO;

use Pipress\Domain\Commentaire;

class CommentaireDAO extends DAO 
{
    /**
     * @var \Pipress\DAO\ArticleDAO
     */
    private $articleDAO;

    public function setArticleDAO(ArticleDAO $articleDAO) {
        $this->articleDAO = $articleDAO;
    }

    /**
     * Return a list of all comments for an article, sorted by date (most recent last).
     *
     * @param integer $articleId The article id.
     *
     * @return array A list of all comments for the article.
     */
    public function findAllByArticle($articleId) {
        // The associated article is retrieved only once
        $article = $this->articleDAO->find($articleId);

        // art_id is not selected by the SQL query
        // The article won't be retrieved during domain objet construction
        $sql = "SELECT *
            FROM commentaires AS c
            INNER JOIN utilisateurs AS u 
            ON c.id_utilisateurs_commentaires = u.id_utilisateurs
            WHERE c.id_articles_commentaires = ?";
        $result = $this->getDb()->fetchAll($sql, array($articleId));

        // Convert query result to an array of domain objects
        $comments = array();
        foreach ($result as $row) {
            $comId = $row['id_commentaires'];
            $comment = $this->buildDomainObject($row);
            // The associated article is defined for the constructed comment
            $comment->setArticle($article);
            $comments[$comId] = $comment;
        }
        return $comments;
    }


    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \Pipress\Domain\Commentaire|throws an exception if no matching user is found
     */
    public function findAllByUser($id) {
        $sql = "SELECT * 
            FROM utilisateurs AS u 
            INNER JOIN commentaires AS c
            ON u.id_utilisateurs = c.id_utilisateurs_commentaires
            WHERE u.login = ?";
        $result = $this->getDb()->fetchAll($sql, array($id));

        // Convert query result to an array of domain objects
        $comments = array();
        foreach ($result as $row) {
            $comId = $row['id_commentaires'];
            $comment = $this->buildDomainObject($row);
            $article = $this->articleDAO->find($row['id_articles_commentaires']);
            $comment->setArticle($article);
            $comments[$comId] = $comment;
        }
        return $comments;
    }

   /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \Pipress\Domain\Commentaire|throws an exception if no matching user is found
     */
    public function findAllByUserCible($id) {
        $sql = "SELECT * 
            FROM utilisateurs AS u 
            INNER JOIN commentaires AS c
            ON u.id_utilisateurs = c.id_utilisateurs_commentaires
            WHERE c.active_commentaires = 1
            AND u.id_utilisateurs = ?";
        $result = $this->getDb()->fetchAll($sql, array($id));

        // Convert query result to an array of domain objects
        $comments = array();
        foreach ($result as $row) {
            $comId = $row['id_commentaires'];
            $comment = $this->buildDomainObject($row);
            $article = $this->articleDAO->find($row['id_articles_commentaires']);
            $comment->setArticle($article);
            $comments[$comId] = $comment;
        }
        return $comments;
    }


    /**
     * Creates an Commentaire object based on a DB row.
     *
     * @param array $row The DB row containing Commentaire data.
     * @return \Pipress\Domain\Commentaire
     */
    protected function buildDomainObject($row) {
        $comment = new Commentaire();
        $comment->setId($row['id_commentaires']);
        $comment->setAuthor($row['id_utilisateurs_commentaires']);
        $comment->setMessage($row['message_commentaires']);
        $comment->setIdArticle($row['id_articles_commentaires']);
        $comment->setDate($row['date_commentaires']);
        $comment->setStatut($row['active_commentaires']);
        $comment->setPseudo($row['pseudo']);

        if (array_key_exists('id_articles', $row)) {
            // Find and set the associated article
            $articleId = $row['id_articles'];
            $article = $this->articleDAO->find($articleId);
            $comment->setArticle($article);
        }
        
        return $comment;
    }
}