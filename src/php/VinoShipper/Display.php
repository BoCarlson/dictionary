<?php
/**
 * Helper class with common display code methods
 */
namespace VinoShipper;

class Display
{
    /**
     * Builds a UL with H4 header from mysqli_result data
     *
     * @param string         $headerText The text to display in the H4
     * @param \mysqli_result $listData   The data to display in the UL
     * @param string         $column     Column to display from the row, default term
     *
     * @return string HTML string
     */
    function listWithHeader(string $headerText, \mysqli_result $listData, string $column = 'term')
    {
        ob_start();

        ?>
        <h4><?= $headerText ?></h4>
        <ul>
            <?php foreach ($listData as $row) : ?>
                <li><a href="?term=<?= $row[$column] ?>"><?= $row[$column] ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php

        return ob_get_clean();
    }
}
