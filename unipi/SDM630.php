<?php

/**
 * This class is dedicated to read data from SDM630 energy meter.
 *
 * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
 */
class SDM630
{

    /**
     * @var array Registers description. Page 2 - 5.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    const registers = [
        "Phase1LineToNeutralVolts" => [0, 1],        
        "Phase2LineToNeutralVolts" => [2, 3],
        "Phase3LineToNeutralVolts" => [4, 5],
        "Phase1Current" => [6, 7],
        "Phase2Current" => [8, 9],
        "Phase3Current" => [10, 11],
        "Phase1Power" => [12, 13],
        "Phase2Power" => [14, 15],
        "Phase3Power" => [16, 17],
        "Phase1VoltAmps" => [18, 18],
        "Phase2VoltAmps" => [20, 21],
        "Phase3VoltAmps" => [22, 23],
        "Phase1VoltAmpsReactive" => [24, 25],
        "Phase2VoltAmpsReactive" => [26, 27],
        "Phase3VoltAmpsReactive" => [28, 29],
        "Phase1PowerFactor" => [30, 31],
        "Phase2PowerFactor" => [32, 33],
        "Phase3PowerFactor" => [34, 35],
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

        foreach(SDM630::registers as $key => $value)
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

        foreach(SDM630::registers as $key => $value)
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

        if (empty(SDM630::registers[$parameter_name]))
        {
            throw new InvalidArgumentException("Missing parameter.");
        }

        /** @var integer Register 1 index $reg1 */
        $reg1 = $registers[SDM630::registers[$parameter_name][0]];
        /** @var integer Register 2 index $reg2 */
        $reg2 = $registers[SDM630::registers[$parameter_name][1]];

        return SDM630::registersToFlaot($reg1, $reg2);
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
        $parameters = SDM630::getParameters();

        if (empty($registers))
        {
            throw new InvalidArgumentException("Invalid registers.");
        }

        foreach($parameters as $parameter)
        {
            $values[$parameter] = SDM630::getParammeter($registers, $parameter);
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
