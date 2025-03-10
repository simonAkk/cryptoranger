<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Comment;
use \OCFram\Page;

abstract class CommentsManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un commentaire.
   * @param $comment Le commentaire à ajouter
   * @return void
   */
  abstract protected function add(Comment $comment);

  /**
   * Méthode permettant de supprimer un commentaire.
   * @param $id L'identifiant du commentaire à supprimer
   * @return void
   */
  abstract public function delete($id);

  /**
   * Méthode permettant de supprimer tous les commentaires liés à une news
   * @param $news L'identifiant de la news dont les commentaires doivent être supprimés
   * @return void
   */
  abstract public function deleteFromNews($news);
  
  /**
   * Méthode permettant d'enregistrer un commentaire.
   * @param $comment Le commentaire à enregistrer
   * @return void
   */
  public function save(Comment $comment)
  {
    if ($comment->isValid())
    {
      $comment->isNew() ? $this->add($comment) : $this->modify($comment);
    }
    else
    {
      throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
    }
  }
  
  /**
   * Méthode permettant de récupérer une liste de commentaires.
   * @param $news La news sur laquelle on veut récupérer les commentaires
   * @return array
   */
  abstract public function getListOf($news);

  /**
   * Méthode permettant de modifier un commentaire.
   * @param $comment Le commentaire à modifier
   * @return void
   */
  abstract protected function modify(Comment $comment);
  
  /**
   * Méthode permettant d'obtenir un commentaire spécifique.
   * @param $id L'identifiant du commentaire
   * @return Comment
   */
  abstract public function getComment($id_comment);

  /**
   * Méthode permettant d'obtenir le nombre total de pages de commentaires à afficher sur la page de la news.
   * @param $id_news L'identifiant de la news/guide en question.
   * @return int le nombre de pages.
   */
  abstract public function numberPagesComments($id_news, $comments_by_page);

  /**
   * Méthode permettant de récupérer une liste de commentaires pour la page.
   * @param $news La news sur laquelle on veut récupérer les commentaires
   * @param $start_page La page à laquelle la LIMIT va commencer.
   * @param $comment_by_page Le Pas de LIMIT.
   * @return array
   */
  abstract public function getListOfComments($news, $start_page, $comments_by_page);
  abstract public function paginateComments(Page &$page, $id, $perPage);
}