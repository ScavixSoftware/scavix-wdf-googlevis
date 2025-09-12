<?php
/**
 * Parser Generator for PHP
 *
 * LICENSE
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 *
 * @package    MC_Parser
 * @author     Chadwick Morris <chad@mailchimp.com>
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 */

class MC_Parser_Token_Group extends MC_Parser_Token implements Countable {
    public $subtoks = [];

    public function __construct($name)
    {
        parent::__construct(null, $name);
    }

    /**
     * Append one or more tokens to this group
     * @param array|MC_Parser_Token one or more token instances
     */
    public function append($toks)
    {
        if ($toks === null)
            return;
        if (!is_array($toks))
            $toks = [$toks];
        $this->subtoks = array_merge($this->subtoks, $toks);
    }

    public function count()
    {
        return count($this->subtoks);
    }

    public function getValues()
    {
        $values = [];
        foreach ($this->subtoks as $tok)
        {
            $values = array_merge($values, $tok->getValues());
        }

        return $values;
    }

    public function getNameValues()
    {
        $values = [];
        foreach($this->subtoks as $tok) {
            $values = array_merge($values, $tok->getNameValues());
        }
        return $values;
    }

    public function hasChildren() {
        return !empty($this->subtoks);
    }

    public function getChildren() {
        return $this->subtoks;
    }
}

?>
