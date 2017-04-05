<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 31.03.2017
 * Time: 17:27
 */

namespace Source\Models\DBAdapters;

/**
 * Class DatabaseAdapter
 * This class provides a valid database-connection for executing
 * queries and collecting the data.
 *
 * @package Source\Models
 */
class DatabaseAdapter {

    protected $dbhost;
    protected $dbname;
    protected $dbuser;
    protected $dbpass;
    protected $tablenames;
    protected $dateformat;
    /** @var  \PDO */
    protected $dbConnection;

    // optional settings
    protected $charset; // for example "utf8"
    protected $collation; // for example "utf8_unicode_ci"

    /**
     * DatabaseAdapter constructor.
     * @param $settings - The DB-settings (containing host information, tablenames, etc.)
     * @throws \PDOException
     */
    function __construct($settings) {
        $this->dbhost = $settings['host'];
        $this->dbuser = $settings['username'];
        $this->dbpass = $settings['password'];
        $this->dbname = $settings['name'];
        $this->tablenames = $settings['tablenames'];
        $this->dateformat = $settings['dateformat'];
        $this->charset = $settings['charset'];
        $this->collation = $settings['collation'];
        try {
            $this->dbConnection = new \PDO ("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
            $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * @return array - the tablenames
     */
    function getTablenames(){
        return $this->tablenames;
    }

    /**
     * @return string - the used dateformat
     */
    public function getDateformat() {
        return $this->dateformat;
    }

    /**
     * @return \PDO the Database-Connection
     * @throws \PDOException
     */
    function getConnection(){
        if($this->dbConnection == null){
            try {
                $this->dbConnection = new \PDO ("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
                $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                throw $e;
            }
        }
        return $this->dbConnection;
    }
}