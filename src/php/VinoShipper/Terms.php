<?php
/**
 * Handles all terms related database interaction
 */
namespace VinoShipper;

class Terms
{
    private $mysqli = null;

    /**
     * Set up internal mysqli
     *
     * @param \mysqli $mysqli
     */
    public function __construct(\mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * Lists terms that do not have a definition in the database
     *
     * @param int $limit Limit the amount of records returned, default 10
     *
     * @return mysqli_result|bool Returns mysqli_result if terms are found, false otherwise
     */
    public function listUndefined(int $limit = 10)
    {
        return $this->mysqli->query(
            "SELECT DISTINCT `term`.*
            FROM `term`
            LEFT JOIN `definition`
            ON `term`.`id` = `definition`.`term_id`
            WHERE `definition`.`id` IS NULL
            ORDER BY `search_count` DESC, `last_search_tstamp` DESC
            LIMIT $limit"
        );
    }

    /**
     * Save or update a term. If a term already exists search count will be incremented and
     * timestamp will be updated
     *
     * @param string $term Term to save or update
     *
     * @return bool True on successful save or update, false otherwise
     */
    public function saveOrUpdate($term) {
        $term = $this->mysqli->real_escape_string($term);

        return $this->mysqli->query(
            "INSERT INTO `term` (`term`)
            VALUES ('$term')
            ON DUPLICATE KEY UPDATE `last_search_tstamp` = now(), `search_count` = `search_count` + 1"
        );
    }
}
