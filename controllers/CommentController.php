<?php

declare(strict_types=1);

class CommentController 
{
    /**
     * Ajoute un commentaire.
     * @return void
     */
    public function addComment() : void
    {
        // Récupération des données du formulaire.
        $pseudo = Utils::request("pseudo");
        $content = Utils::request("content");
        $idArticle = Utils::request("idArticle");
        $idArticle = filter_var($idArticle, FILTER_VALIDATE_INT);

        // On vérifie que les données sont valides.
        if (empty($pseudo) || empty($content) || empty($idArticle)) {
            throw new Exception("Tous les champs sont obligatoires. 3");
        }

        // On vérifie que l'article existe.
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($idArticle);
        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }

        // On crée l'objet Comment.
        $comment = new Comment([
            'pseudo' => $pseudo,
            'content' => $content,
            'idArticle' => $idArticle
        ]);

        // On ajoute le commentaire.
        $commentManager = new CommentManager();
        $result = $commentManager->addComment($comment);

        // On vérifie que l'ajout a bien fonctionné.
        if (!$result) {
            throw new Exception("Une erreur est survenue lors de l'ajout du commentaire.");
        }

        // On redirige vers la page de l'article.
        Utils::redirect("showArticle", ['id' => $idArticle]);
    }

    public function deleteComment(): void
    {
        if (isset($_SESSION['user'])){
        
            $commentId = Utils::request('id', -1);
            $commentId = filter_var($commentId, FILTER_VALIDATE_INT);
            $articleId = Utils::request('articleId', -1);
            $articleId = filter_var($articleId, FILTER_VALIDATE_INT);

            if ($commentId > 0 && $articleId > 0)
                {
                    $commentManager = new CommentManager();
                    $comment = $commentManager->getCommentById($commentId);
                    $commentManager->deleteComment($comment);

                    Utils::redirect("showArticle", ['id' => $articleId]);
                }
            else 
                {
                    throw new Exception("Paramètres invalides");
                }
        }
        else {
            throw new Exception("Action impossible, vous n'êtes pas admin");
        }
    }
}