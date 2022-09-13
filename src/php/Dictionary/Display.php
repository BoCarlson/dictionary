<?php
/**
 * Helper class with common display code methods
 */
namespace App\Dictionary;

class Display
{
    /**
     * Builds a UL with header from mysqli_result data
     *
     * @param string         $headerText  The text to display in the H4
     * @param \mysqli_result $listData    The data to display in the UL
     * @param string         $column      Column to display from the row, default term
     * @param string         $emptyText   Text to display if the list is empty, default "None"
     * @param string         $listClasses Optional CSS classes to apply to list, default 'results'
     * @param string         $headerType  Header type to use, default h2
     *
     * @return string HTML string
     */
    function listWithHeader(
        string $headerText,
        \mysqli_result $listData,
        string $column      = "term",
        string $emptyText   = "None",
        string $listClasses = "results",
        string $headerType  = "h2"
    )
    {
        ob_start();

        ?>
        <<?= $headerType ?>><?= $headerText ?></<?= $headerType ?>>
        <ul class="<?= $listClasses ?>">
            <?php if($listData->num_rows) : ?>
                <?php foreach ($listData as $row) : ?>
                    <li><a href="?term=<?= $row[$column] ?>"><?= $row[$column] ?></a></li>
                <?php endforeach; ?>
            <?php else : ?>
                <li><?= $emptyText ?></li>
            <?php endif; ?>
        </ul>
        <?php

        return ob_get_clean();
    }
}
