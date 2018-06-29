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
        "Phase1VoltAmps" => [18, 19],
        "Phase2VoltAmps" => [20, 21],
        "Phase3VoltAmps" => [22, 23],
        "Phase1VoltAmpsReactive" => [24, 25],
        "Phase2VoltAmpsReactive" => [26, 27],
        "Phase3VoltAmpsReactive" => [28, 29],
        "Phase1PowerFactor" => [30, 31],
        "Phase2PowerFactor" => [32, 33],
        "Phase3PowerFactor" => [34, 35],
        "Phase1PhaseAngle" => [36, 37],
        "Phase2PhaseAngle" => [38, 39],
        "Phase3PhaseAngle" => [40, 41],
        "AverageLineToNeutralVolts" => [42, 43],
        "AverageLineCurrent" => [46, 47],
        "SumOfLineCurrents" => [48, 49],
        "TotalSystemPower" => [52, 53],
        "TotalSystemVoltAmps" => [56, 57],
        "TotalSystemVar" => [60, 61],
        "TotalSystemPowerFactor" => [62, 63],
        "TotalSystemPhaseAngle" => [66, 67],
        "FrequencyOfSupplyVoltages" => [70, 71],
        "TotalImportKwh" => [72, 73],
        "TotalExportKwh" => [74, 75],
        "TotalImportKvarh" => [76, 77],
        "TotalExportKvarh" => [78, 79],
        "TotalVah" => [80, 81],
        "Ah" => [82, 83],
        "TotalSystemPowerDemand" => [84, 85],
        "MaximumTotalSystemPowerDemand" => [86, 87],
        "TotalSystemVaDemand" => [100, 101],
        "MaximumTotalSystemVaDemand" => [102, 103],
        "NeutralCurrentDemand" => [104, 105],
        "MaximumNeutralCurrentDemand" => [106, 107],
        "Line1ToLine2Volts" => [200, 201],
        "Line2ToLine3Volts" => [202, 203],
        "Line3ToLine1Volts" => [204, 205],
        "AverageLineToLineVolts" => [206, 207],
        "NeutralCurrent" => [224, 225],
        "Phase1L/NVoltsThd" => [234, 235],
        "Phase2L/NVoltsThd" => [236, 237],
        "Phase3L/NVoltsThd" => [238, 239],
        "Phase1CurrentThd" => [240, 241],
        "Phase2CurrentThd" => [242, 243],
        "Phase3CurrentThd" => [244, 245],
        "AverageLineToNeutralVoltsThd" => [248, 249],
        "AverageLineCurrentThd" => [250, 251],
        "Phase1CurrentDemand" => [257, 258],
        "Phase2CurrentDemand" => [259, 260],
        "Phase3CurrentDemand" => [261, 262],
        "MaximumPhase1CurrentDemand" => [263, 264],
        "MaximumPhase2CurrentDemand" => [265, 266],
        "MaximumPhase3CurrentDemand" => [267, 268],
        "Line1ToLine2VoltsThd" => [333, 334],
        "Line2ToLine3VoltsThd" => [335, 336],
        "Line3ToLine1VoltsThd" => [337, 338],
        "AverageLineToLineVoltsThd" => [339, 340],
        "TotalKwh" => [341, 342],
        "TotalKvarh" => [343, 344],
        "L1ImportKwh" => [345, 346],
        "L2ImportKwh" => [347, 348],
        "L3ImportKwh" => [349, 350],
        "L1ExportKwh" => [351, 352],
        "L2ExportKwh" => [353, 354],
        "L3ExportKwh" => [355, 356],
        "L1TotalKwh" => [357, 358],
        "L2TotalKwh" => [359, 360],
        "L3TotalKwh" => [361, 362],
        "L1ImportKvarh" => [363, 364],
        "L2ImportKvarh" => [365, 366],
        "L3ImportKvarh" => [367, 368],
        "L1ExportKvarh" => [369, 370],
        "L2ExportKvarh" => [371, 372],
        "L3ExportKvarh" => [373, 374],
        "L1TotalKvarh" => [375, 376],
        "L2TotalKvarh" => [377, 378],
        "L3TotalKvarh" => [379, 380]
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
