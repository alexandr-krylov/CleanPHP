<?php
/**
 * Abstract Entity
 * php version 7.3.7
 * 
 * @category Abstract
 * @package  CleanPhp
 * @author   Alexandr Krylov <alexandr.krylov@gmail.com>
 * @license  http://www.gnu.org/licenses/agpl-3.0.html AGPLv3
 * @version  GIT: <0.0>
 * @link     https://github.com/alexandr-krylov/CleanPHP.git
 */

namespace CleanPhp\Invoicer\Domain\Entity;

/**
 * Abstract Entity
 * 
 * @category Abstract
 * @package  CleanPhp
 * @author   Alexandr Krylov <alexandr.krylov@gmail.com>
 * @license  http://www.gnu.org/licenses/agpl-3.0.html AGPLv3
 * @link     https://github.com/alexandr-krylov/CleanPHP.git
 */
abstract class AbstractEntity
{
    protected $id;

    /**
     * Getter for $id
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * $id int
     * Setter for $id
     * 
     * @name 
     * @param $id int
     * 
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }
}