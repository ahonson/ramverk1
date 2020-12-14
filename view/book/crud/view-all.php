<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("book/create");
$urlToDelete = url("book/delete");



?><h1>Visa samtliga böcker</h1>

<p>
    <a href="<?= $urlToCreate ?>">Skapa</a> |
    <a href="<?= $urlToDelete ?>">Radera</a>
</p>

<?php if (!$items) : ?>
    <p>Det finns inga böcker att visa.</p>
<?php
    return;
endif;
?>

<table class="booktable">
    <tr>
        <th>Id</th>
        <th>Författare</th>
        <th>Titel</th>
        <th>Bild</th>
    </tr>
    <?php foreach ($items as $item) : ?>
    <tr>
        <td class="bookid">
            <a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td class="bookdata"><?= $item->column1 ?></td>
        <td class="bookdata"><?= $item->column2 ?></td>
        <td class="bookimage"><img src="<?= $item->column3 ?>" alt="<?= $item->column2 ?>"></td>
    </tr>
    <?php endforeach; ?>
</table>
