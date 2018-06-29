<?php

/**
 * This class is dedicated to read data from SDM120 energy meter.
 *
 * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf
 */
class SDM120
{
    /**
     * @var array Registers description. Page 5 - 6.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf
     */
    const registers = [
        "Voltage" => [0, 1],
        "Current" => [6, 7],
        "ActivePower" => [12, 13],
        "ApparentPower" => [18, 19],
        "ReactivePower" => [24, 25],
        "PowerFactor" => [30, 31],
        "Frequency" => [70, 71],
        "ImportActiveEnergy" => [72, 73],
        "ExportActiveEnergy" => [74, 75],
        "ImportReactiveEnergy" => [76, 77],
        "ExportReactiveEnergy" => [78, 79],
        "TotalSystemPowerDemand" => [84, 85],
        "MaximumTotalSystemPowerDemand" => [86, 87],
        "ImportSystemPowerDemand" => [88, 89],
        "MaximumImportSystemPowerDemand" => [90, 91],
        "ExportSystemPowerDemand" => [92, 93],
        "MaximumExportSystemPowerDemand" => [94, 95],
        "CurrentDemand." => [257, 258],
        "MaximumCurrentDemand." => [263, 264],
        "TotalActiveEnergy" => [341, 342],
        "TotalReactiveEnergy" => [343, 344],
    ];

    /**
     * Get registers IDs.
     *
     * @return array IDs.
     */
    public static function getRegistersIDs()
    {
        /** @var array Registers IDs $registers_ids */
        $registers_ids = [];
        
        foreach(SDM120::registers as $key => $value)
        {
            array_push($registers_ids, $value[0], $value[1]);
        }
        
        return $registers_ids;
    }

    /**
     * Get parameters names.
     *
     * @return array names.
     */
    public static function getParameters()
    {
        /** @var array Parameters names $parameters */
        $parameters = array();
        
        foreach(SDM120::registers as $key => $value)
        {
            array_push($parameters, $key);
        }
        
        return $parameters;
    }

    /**
     * Get value by the content.
     *
     * @param string $parameter_name Parameter name.
     * @param array $registers Device parameter name.
     * @return float Parameter value.
     * @throws Exception InvalidArgumentException
     */
    public static function getParammeter($registers, $parameter_name)
    {
        if (empty($parameter_name))
        {
            throw new InvalidArgumentException("Invalid parameter name.");
        }

        if (empty(SDM120::registers[$parameter_name]))
        {
            throw new InvalidArgumentException("Missing parameter.");
        }

        /** @var integer Register 1 index $reg1 */
        $reg1 = $registers[SDM120::registers[$parameter_name][0]];
        /** @var integer Register 2 index $reg2 */
        $reg2 = $registers[SDM120::registers[$parameter_name][1]];

        return SDM120::registersToFlaot($reg1, $reg2);
    }

    /**
     * Get value byt the content.
     *
     * @param object $content MODBUS data.
     * @return array Parameters values.
     * @throws Exception InvalidArgumentException
     */
    public static function getParammeters($registers)
    {
        /** @var array Values $values */
        $values = array();

        /** @var array Parameters $parameters */
        $parameters = SDM120::getParameters();

        if (empty($registers))
        {
            throw new InvalidArgumentException("Invalid registers.");
        }

        foreach($parameters as $parameter)
        {
            $values[$parameter] = SDM120::getParammeter($registers, $parameter);
        }

        return $values;
    }

    /**
     * Convert two registers to float.
     *
     * @param integer $reg_value1 Register 1.
     * @param integer $reg_value2 Register 2.
     * @return float Value from two registers.
     */
    private static function registersToFlaot($reg_value1, $reg_value2)
    {

        /** @var array Packet binary data. $bin_data */
        $bin_data = null;

        /** @var float Unpacked float value. $value */
        $value = NAN;

        if (isset($reg_value1))
        {
            if (isset($reg_value2))
            {
                $bin_data = pack("nn", $reg_value1, $reg_value2);
            }
        }

        if ($bin_data != null)
        {
            $value = unpack("G", $bin_data)[1];
        }

        return $value;
    }
    
}