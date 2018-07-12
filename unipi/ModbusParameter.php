<?php

/**
 * This class is dedicated to describe one modbus parameter.
 */
class ModbusParameter
{

    #region Variables

    /**
     * Parameter name.
     *
     * @var string
     */
    private $parameter_name = 'Parameter';

    /**
     * Measure of unit.
     *
     * @var integer
     */
    private $mou = 'Unit';

    /**
     * Data type.
     *
     * @var integer
     */
    private $type = '';

    /**
     * Modbus addresses.
     *
     * @var array
     */
    private $adresses = array();

    #endregion

    #region Constructor

    /**
     * Class constructor.
     *
     * @param string $parameter_name Parameter name.
     * @param string $mou Measure of unit.
     * @param string $type Data type.
     * @param array $adresses Modbus addresses.
     */
    public function __construct($parameter_name, $mou, $type, $adresses)
    {
        $this->setParameterName($parameter_name);
        $this->setMou($mou);
        $this->setType($type);
        $this->setAdresses($adresses);
    }

    #endregion

    #region Getters and Setters

    /**
     * @return string
     */
    public function getParameterName()
    {
        return $this->parameter_name;
    }

    /**
     * @param string $parameter_name
     */
    public function setParameterName($parameter_name)
    {
        $this->parameter_name = $parameter_name;
    }

    /**
     * @return int
     */
    public function getMou()
    {
        return $this->mou;
    }

    /**
     * @param int $mou
     */
    public function setMou($mou)
    {
        $this->mou = $mou;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getAdresses()
    {
        return $this->adresses;
    }

    /**
     * @param array $adresses
     */
    public function setAdresses($adresses)
    {
        $this->adresses = $adresses;
    }

    #endregion

}