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
    const registers = array(
        "Phase1LineToNeutralVolts" => array(0, 1),
        "Phase2LineToNeutralVolts" => array(2, 3),
        "Phase3LineToNeutralVolts" => array(4, 5),
        "Phase1Current" => array(6, 7),
        "Phase2Current" => array(8, 9),
        "Phase3Current" => array(10, 11),
        "Phase1Power" => array(12, 13),
        "Phase2Power" => array(14, 15),
        "Phase3Power" => array(16, 17),
        "Phase1VoltAmps" => array(18, 19),
        "Phase2VoltAmps" => array(20, 21),
        "Phase3VoltAmps" => array(22, 23),
        "Phase1VoltAmpsReactive" => array(24, 25),
        "Phase2VoltAmpsReactive" => array(26, 27),
        "Phase3VoltAmpsReactive" => array(28, 29),
        "Phase1PowerFactor" => array(30, 31),
        "Phase2PowerFactor" => array(32, 33),
        "Phase3PowerFactor" => array(34, 35),
        "Phase1PhaseAngle" => array(36, 37),
        "Phase2PhaseAngle" => array(38, 39),
        "Phase3PhaseAngle" => array(40, 41),
        "AverageLineToNeutralVolts" => array(42, 43),
        "AverageLineCurrent" => array(46, 47),
        "SumOfLineCurrents" => array(48, 49),
        "TotalSystemPower" => array(52, 53),
        "TotalSystemVoltAmps" => array(56, 57),
        "TotalSystemVar" => array(60, 61),
        "TotalSystemPowerFactor" => array(62, 63),
        "TotalSystemPhaseAngle" => array(66, 67),
        "FrequencyOfSupplyVoltages" => array(70, 71),
        "TotalImportKwh" => array(72, 73),
        "TotalExportKwh" => array(74, 75),
        "TotalImportKvarh" => array(76, 77),
        "TotalExportKvarh" => array(78, 79),
        "TotalVah" => array(80, 81),
        "Ah" => array(82, 83),
        "TotalSystemPowerDemand" => array(84, 85),
        "MaximumTotalSystemPowerDemand" => array(86, 87),
        "TotalSystemVaDemand" => array(100, 101),
        "MaximumTotalSystemVaDemand" => array(102, 103),
        "NeutralCurrentDemand" => array(104, 105),
        "MaximumNeutralCurrentDemand" => array(106, 107),
        "Line1ToLine2Volts" => array(200, 201),
        "Line2ToLine3Volts" => array(202, 203),
        "Line3ToLine1Volts" => array(204, 205),
        "AverageLineToLineVolts" => array(206, 207),
        "NeutralCurrent" => array(224, 225),
        "Phase1L/NVoltsThd" => array(234, 235),
        "Phase2L/NVoltsThd" => array(236, 237),
        "Phase3L/NVoltsThd" => array(238, 239),
        "Phase1CurrentThd" => array(240, 241),
        "Phase2CurrentThd" => array(242, 243),
        "Phase3CurrentThd" => array(244, 245),
        "AverageLineToNeutralVoltsThd" => array(248, 249),
        "AverageLineCurrentThd" => array(250, 251),
        "Phase1CurrentDemand" => array(257, 258),
        "Phase2CurrentDemand" => array(259, 260),
        "Phase3CurrentDemand" => array(261, 262),
        "MaximumPhase1CurrentDemand" => array(263, 264),
        "MaximumPhase2CurrentDemand" => array(265, 266),
        "MaximumPhase3CurrentDemand" => array(267, 268),
        "Line1ToLine2VoltsThd" => array(333, 334),
        "Line2ToLine3VoltsThd" => array(335, 336),
        "Line3ToLine1VoltsThd" => array(337, 338),
        "AverageLineToLineVoltsThd" => array(339, 340),
        "TotalKwh" => array(341, 342),
        "TotalKvarh" => array(343, 344),
        "L1ImportKwh" => array(345, 346),
        "L2ImportKwh" => array(347, 348),
        "L3ImportKwh" => array(349, 350),
        "L1ExportKwh" => array(351, 352),
        "L2ExportKwh" => array(353, 354),
        "L3ExportKwh" => array(355, 356),
        "L1TotalKwh" => array(357, 358),
        "L2TotalKwh" => array(359, 360),
        "L3TotalKwh" => array(361, 362),
        "L1ImportKvarh" => array(363, 364),
        "L2ImportKvarh" => array(365, 366),
        "L3ImportKvarh" => array(367, 368),
        "L1ExportKvarh" => array(369, 370),
        "L2ExportKvarh" => array(371, 372),
        "L3ExportKvarh" => array(373, 374),
        "L1TotalKvarh" => array(375, 376),
        "L2TotalKvarh" => array(377, 378),
        "L3TotalKvarh" => array(379, 380)
    );

    /**
     * Get registers IDs.
     *
     * @return array IDs.
     */
    public static function getRegistersIDs()
    {
        /** @var array Registers IDs $registers_ids */
        $registers_ids = array();

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
