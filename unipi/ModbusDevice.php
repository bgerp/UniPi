<?php

require_once ('ModbusDataTypes.php');

require_once ('ModbusParameter.php');

/**
 * This class is MODBUS composite device.
 */
class ModbusDevice
{

    #region Variables

    /**
     * Device registers.
     *
     * @var array
     */
    private $registers = array();

    #endregion

    #region Constructor

    /**
     * Class constructor.
     *
     * @param array $registers Modbus registers.
     */
    public function __construct($registers)
    {
        $this->setRegisters($registers);
    }

    #endregion

    #region Getters and Setters

    /**
     * Returns device registers.
     *
     * @return array
     */
    public function getRegisters()
    {
        return $this->registers;
    }

    /**
     * Sets device registers.
     *
     * @param array $registers
     */
    public function setRegisters($registers)
    {
        $this->registers = $registers;
    }

    #endregion

    #region Public Methods

    /**
     * Get registers IDs.
     *
     * @return array IDs.
     */
    public function getRegistersIDs()
    {
        /** @var array Registers IDs $registers_ids */
        $registers_ids = array();

        $reg_count = count($this->registers);

        for ($reg_index = 0; $reg_index < $reg_count; $reg_index++)
        {
            $addresses = $this->registers[$reg_index]->getAdresses();

            $adr_count = count($addresses);

            for ($adr_index = 0; $adr_index < $adr_count; $adr_index++)
            {
                array_push($registers_ids, $addresses[$adr_index]);
            }
        }

        return $registers_ids;
    }

    /**
     * Get parameters names.
     *
     * @return array names.
     */
    public function getParametersNames()
    {
        /** @var array Parameters names $parameters */
        $parameters = array();

        $reg_count = count($this->registers);

        for ($reg_index = 0; $reg_index < $reg_count; $reg_index++)
        {
            $parameter_name = $this->registers[$reg_index]->getParameterName();

            array_push($parameters, $parameter_name);
        }

        return $parameters;
    }

    /**
     * Returns parameter value.
     *
     * @param string $parameter Parameter name.
     * @param array $registers Registers data,
     * @return null, mixed
     * @throws Exception
     */
    public function getParameterValue($parameter, $registers)
    {
        if (empty($parameter))
        {
            throw new InvalidArgumentException("Invalid parameter name.");
        }

        if (empty($this->registers))
        {
            throw new InvalidArgumentException("Missing parameter.");
        }


        $reg_count = count($this->registers);
        $value = null;

        for ($reg_index = 0; $reg_index < $reg_count; $reg_index++)
        {
            $parameter_name = $this->registers[$reg_index]->getParameterName();

            if($parameter == $parameter_name)
            {
                $type = $this->registers[$reg_index]->getType();
                $addresses = $this->registers[$reg_index]->getAdresses();
                $value = $this->convertParameter($type, $addresses, $registers);
                break;
            }
        }

        return $value;
    }

    /**
     * Returns parameters valus.
     *
     * @param array $registers Registers data.
     * @return array Array of parametters valus.
     * @throws Exception
     */
    public function getParametersValues($registers)
    {

        if (empty($registers))
        {
            throw new InvalidArgumentException("Invalid registers.");
        }

        /** @var array Parameters $parameters */
        $parameters = $this->getParametersNames();

        /** @var array Values $values */
        $values = array();

        foreach($parameters as $parameter)
        {
            $values[$parameter] = $this->getParameterValue($parameter, $registers);
        }

        return $values;
    }

    #endregion

    #region Private Methods

    /**
     * Covert registers to single value.
     *
     * @param string $type Data type.
     * @param array $registers Registers addresses.
     * @param array $registers_data Registers data.
     * @return string Value
     * @throws Exception
     */
    private function convertParameter($type, $registers, $registers_data)
    {
        if(!ModbusDataTypes::isValidName($type))
        {
            throw new Exception("Modbus data type missmatch.");
        }

        if(count($registers) <= 0)
        {
            throw new Exception("Invalid registers length.");
        }

        /** @var object Unpacked float value. $value */
        $value = null;

        if($type == ModbusDataTypes::INT16_T)
        {
            $value = $registers_data[$registers[0]];
        }
        else if($type == ModbusDataTypes::UINT16_T)
        {
            $value = $registers_data[$registers[0]];
        }
        else if($type == ModbusDataTypes::INT32_T)
        {
            throw  new Exception("Not implemented");
        }
        else if($type == ModbusDataTypes::UINT32_T)
        {
            throw  new Exception("Not implemented");
        }
        else if($type == ModbusDataTypes::FLOAT)
        {
            /** @var array Packet binary data. $bin_data */
            $bin_data = null;

            $bin_data = pack(
                "nn",
                $registers_data[$registers[0]],
                $registers_data[$registers[1]]);

            $value = unpack("G", $bin_data)[1];
        }

        return $value;
    }

    #endregion

}