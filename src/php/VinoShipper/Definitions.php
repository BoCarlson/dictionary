<?php
/**
 * Handles all definitions related database interaction
 */
namespace VinoShipper;

class Definitions
{
    private $mysqli = null;
    private $logger = null;

    /**
     * Set up internal mysqli and logger
     *
     * @param \mysqli $mysqli
     * @param \Monolog\Logger $logger
     */
    public function __construct(\mysqli $mysqli, \Monolog\Logger $logger = null)
    {
        $this->mysqli = $mysqli;
        $this->logger = $logger;
    }

    /**
     * List definitions that have been recently added to the database
     *
     * @return \mysqli_result Rows of results from query
     */
    public function listRecent(int $limit = 10)
    {
        return $this->mysqli->query(
            "SELECT `term`.*
            FROM `term`
            JOIN `definition`
            ON `term`.`id` = `definition`.`term_id`
            ORDER BY `last_search_tstamp` DESC
            LIMIT $limit"
        );
    }

    /**
     * Look up a definition for a term
     *
     * @param string $term Term to look up
     *
     * @return \mysqli_result Rows of results from query
     */
    public function lookupByTerm(string $term)
    {
        $term = $this->mysqli->real_escape_string($term);

        return $this->mysqli->query(
            "SELECT `definition`.*
            FROM `definition`
            JOIN `term`
            ON `term`.`id` = `definition`.`term_id`
            WHERE `term`.`term` = '$term'"
        );
    }

    /**
     * Save a definition for a term to the database
     *
     * @param string $term       Term for the definition
     * @param string $definition Definition that will be saved to the term
     *
     * @return
     */
    public function save(string $term, string $definition)
    {
        $term       = $this->mysqli->real_escape_string($term);
        $definition = $this->mysqli->real_escape_string($definition);
        $success    = false;

        $termId = $this->mysqli->query(
            "SELECT *
            FROM term
            where term='$term'"
        )->fetch_row()[0];

        if($termId) {
            $success = $this->mysqli->query(
                "INSERT INTO `definition` (`term_id`, `text`)
                VALUES ('$termId', '$definition')"
            );

            if(!$success) {

            }
        }

        return $success;
    }
}
