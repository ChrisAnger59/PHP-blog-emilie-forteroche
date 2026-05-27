<?php 
    /** 
     * Affichage de la partie monitoring : 
     *      - liste des articles par leurs titres
     *      - Avec leur date de création (formaté grace à la méthode static convertDateToFrenchFormat() )
     *      - Avec le nombre de commentaires par articles
     *      - Avec le nombre de "vues" par articles
     */


    $baseUrl = "index.php?action=monitorArticle";
?>

<h2>Suivi des Articles</h2>

    <table class="articleLine">
        <tr class="impaire">
            <th>Titre <a href="<?= $baseUrl ?>&sort=title&order=desc">&#11015</a><a href="<?= $baseUrl ?>&sort=title&order=asc">&#11014</a></th>
            <th>Date <a href="<?= $baseUrl ?>&sort=date&order=desc">&#11015</a><a href="<?= $baseUrl ?>&sort=date&order=asc">&#11014</a></th>
            <th>nb Commentaires <a href="<?= $baseUrl ?>&sort=com&order=desc">&#11015</a><a href="<?= $baseUrl ?>&sort=com&order=asc">&#11014</a></th>
            <th>Vues <a href="<?= $baseUrl ?>&sort=views&order=desc">&#11015</a><a href="<?= $baseUrl ?>&sort=views&order=asc">&#11014</a></th>
        </tr>

        <?php $index = 0; ?>
        <?php foreach ($articles as $article) : ?>

            <tr class="<?= ($index % 2 === 0) ? 'paire' : 'impaire' ?>">
                <td class="title"><?= $article->getTitle() ?></td>
                <td><?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?></td>
                <td><?= $article->getComCount() ?></td>
                <td><?= $article->getViews() ?></td>
            </tr>

            <?php $index ++; ?>
        <?php endforeach ?>
    </table>
</div>