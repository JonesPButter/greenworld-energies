<?php
/**
 * Created by PhpStorm.
 * User: Jones
 * Date: 24.11.2016
 * Time: 12:16
 */

namespace Source\Models\DAOs;

use Source\Models\DBAdapters\DatabaseAdapter;

class AbstractDAO {
    /** @var DatabaseAdapter  */
    protected $dbAdapter;
    protected $tablename;

    /**
     * AbstractDAO constructor.
     * @param DatabaseAdapter $dbAdapter
     */
    public function __construct(DatabaseAdapter $dbAdapter) {
        $this->dbAdapter = $dbAdapter;
        $this->tablename = $this->dbAdapter->getTablenames()['user-table'];
    }
}