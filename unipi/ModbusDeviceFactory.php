<?php

require_once ("ModbusDataTypes.php");
require_once ("ModbusParameter.php");
require_once ("ModbusDevice.php");

/**
 * This class is dedicated to generate concrete modbus device.
 */
class ModbusDeviceFactory
{

    #region Public Methods

    /**
     * Generate SDM120 device.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf
     * @return mixed
     */
    public static function SDM120()
    {
        /** @var array $registers Registers description. Page 5 - 6 */
        $registers = array();

        $registers[0] = new ModbusParameter('Voltage', 'V', ModbusDataTypes::FLOAT, array(0, 1));
        $registers[1] = new ModbusParameter('Current', 'A', ModbusDataTypes::FLOAT, array(6, 7));
        $registers[2] = new ModbusParameter('ActivePower', 'W', ModbusDataTypes::FLOAT, array(12, 13));
        $registers[3] = new ModbusParameter('ApparentPower', 'VA', ModbusDataTypes::FLOAT, array(18, 19));
        $registers[4] = new ModbusParameter('ReactivePower', 'VAr', ModbusDataTypes::FLOAT, array(24, 25));
        $registers[5] = new ModbusParameter('PowerFactor', 'DEG', ModbusDataTypes::FLOAT, array(30, 31));
        $registers[6] = new ModbusParameter('Frequency', 'Hz', ModbusDataTypes::FLOAT, array(70, 71));
        $registers[7] = new ModbusParameter('ImportActiveEnergy', 'kWr', ModbusDataTypes::FLOAT, array(74, 75));
        $registers[8] = new ModbusParameter('ExportActiveEnergy', 'kWr', ModbusDataTypes::FLOAT, array(76, 77));
        $registers[9] = new ModbusParameter('ImportReactiveEnergy', 'kvarh', ModbusDataTypes::FLOAT, array(78, 79));
        $registers[10] = new ModbusParameter('ExportReactiveEnergy', 'kvarh', ModbusDataTypes::FLOAT, array(84, 85));
        $registers[11] = new ModbusParameter('TotalSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(86, 86));
        $registers[12] = new ModbusParameter('MaximumTotalSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(88, 89));
        $registers[13] = new ModbusParameter('ImportSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(90, 91));
        $registers[14] = new ModbusParameter('MaximumImportSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(92, 93));
        $registers[15] = new ModbusParameter('ExportSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(94, 95));
        $registers[16] = new ModbusParameter('MaximumExportSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(257, 258));
        $registers[17] = new ModbusParameter('CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(263, 264));
        $registers[18] = new ModbusParameter('MaximumCurrentDemand', 'W', ModbusDataTypes::FLOAT, array(341, 342));
        $registers[19] = new ModbusParameter('TotalActiveEnergy', 'Kvarh', ModbusDataTypes::FLOAT, array(343, 344));

        return ModbusDeviceFactory::makeDevice($registers);
    }

    /**
     * Generate SDM630 device.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     * @return mixed
     */
    public static function SDM630()
    {
        /** @var array $registers Registers description.*/
        $registers = array();

        $registers[0] = new ModbusParameter("Phase1LineToNeutralVolts", 'V', ModbusDataTypes::FLOAT, array(0, 1));
        $registers[1] = new ModbusParameter("Phase2LineToNeutralVolts", 'V', ModbusDataTypes::FLOAT, array(2, 3));
        $registers[2] = new ModbusParameter("Phase3LineToNeutralVolts", 'V', ModbusDataTypes::FLOAT, array(4, 5));
        $registers[3] = new ModbusParameter("Phase1Current", 'V', ModbusDataTypes::FLOAT, array(6, 7));
        $registers[4] = new ModbusParameter("Phase2Current", 'V', ModbusDataTypes::FLOAT, array(8, 9));
        $registers[5] = new ModbusParameter("Phase3Current", 'V', ModbusDataTypes::FLOAT, array(10, 11));
        $registers[6] = new ModbusParameter("Phase1Power", 'V', ModbusDataTypes::FLOAT, array(12, 13));
        $registers[7] = new ModbusParameter("Phase2Power", 'V', ModbusDataTypes::FLOAT, array(14, 15));
        $registers[8] = new ModbusParameter("Phase3Power", 'V', ModbusDataTypes::FLOAT, array(16, 17));
        $registers[9] = new ModbusParameter("Phase1VoltAmps", 'V', ModbusDataTypes::FLOAT, array(18, 19));
        $registers[10] = new ModbusParameter("Phase2VoltAmps", 'V', ModbusDataTypes::FLOAT, array(20, 21));
        $registers[11] = new ModbusParameter("Phase3VoltAmps", 'V', ModbusDataTypes::FLOAT, array(22, 23));
        $registers[12] = new ModbusParameter("Phase1VoltAmpsReactive", 'V', ModbusDataTypes::FLOAT, array(24, 25));
        $registers[13] = new ModbusParameter("Phase2VoltAmpsReactive", 'V', ModbusDataTypes::FLOAT, array(26, 27));
        $registers[14] = new ModbusParameter("Phase3VoltAmpsReactive", 'V', ModbusDataTypes::FLOAT, array(28, 29));
        $registers[15] = new ModbusParameter("Phase1PowerFactor", 'V', ModbusDataTypes::FLOAT, array(30, 31));
        $registers[16] = new ModbusParameter("Phase2PowerFactor", 'V', ModbusDataTypes::FLOAT, array(32, 33));
        $registers[17] = new ModbusParameter("Phase3PowerFactor", 'V', ModbusDataTypes::FLOAT, array(34, 35));
        $registers[18] = new ModbusParameter("Phase1PhaseAngle", 'V', ModbusDataTypes::FLOAT, array(36, 37));
        $registers[19] = new ModbusParameter("Phase2PhaseAngle", 'V', ModbusDataTypes::FLOAT, array(38, 39));
        $registers[20] = new ModbusParameter("Phase3PhaseAngle", 'V', ModbusDataTypes::FLOAT, array(40, 41));
        $registers[21] = new ModbusParameter("AverageLineToNeutralVolts", 'V', ModbusDataTypes::FLOAT, array(42, 43));
        $registers[22] = new ModbusParameter("AverageLineCurrent", 'V', ModbusDataTypes::FLOAT, array(46, 47));
        $registers[23] = new ModbusParameter("SumOfLineCurrents", 'V', ModbusDataTypes::FLOAT, array(48, 49));
        $registers[24] = new ModbusParameter("TotalSystemPower", 'V', ModbusDataTypes::FLOAT, array(52, 53));
        $registers[25] = new ModbusParameter("TotalSystemVoltAmps", 'V', ModbusDataTypes::FLOAT, array(56, 57));
        $registers[26] = new ModbusParameter("TotalSystemVar", 'V', ModbusDataTypes::FLOAT, array(60, 61));
        $registers[27] = new ModbusParameter("TotalSystemPowerFactor", 'V', ModbusDataTypes::FLOAT, array(62, 63));
        $registers[28] = new ModbusParameter("TotalSystemPhaseAngle", 'V', ModbusDataTypes::FLOAT, array(66, 67));
        $registers[29] = new ModbusParameter("FrequencyOfSupplyVoltages", 'V', ModbusDataTypes::FLOAT, array(70, 71));
        $registers[30] = new ModbusParameter("TotalImportKwh", 'V', ModbusDataTypes::FLOAT, array(72, 73));
        $registers[31] = new ModbusParameter("TotalExportKwh", 'V', ModbusDataTypes::FLOAT, array(74, 75));
        $registers[32] = new ModbusParameter("TotalImportKvarh", 'V', ModbusDataTypes::FLOAT, array(76, 77));
        $registers[33] = new ModbusParameter("TotalExportKvarh", 'V', ModbusDataTypes::FLOAT, array(78, 79));
        $registers[34] = new ModbusParameter("TotalVah", 'V', ModbusDataTypes::FLOAT, array(80, 81));
        $registers[35] = new ModbusParameter("Ah", 'V', ModbusDataTypes::FLOAT, array(82, 83));
        $registers[36] = new ModbusParameter("TotalSystemPowerDemand", 'V', ModbusDataTypes::FLOAT, array(84, 85));
        $registers[37] = new ModbusParameter("MaximumTotalSystemPowerDemand", 'V', ModbusDataTypes::FLOAT, array(86, 87));
        $registers[38] = new ModbusParameter("TotalSystemVaDemand", 'V', ModbusDataTypes::FLOAT, array(100, 101));
        $registers[39] = new ModbusParameter("MaximumTotalSystemVaDemand", 'V', ModbusDataTypes::FLOAT, array(102, 103));
        $registers[40] = new ModbusParameter("NeutralCurrentDemand", 'V', ModbusDataTypes::FLOAT, array(104, 105));
        $registers[41] = new ModbusParameter("MaximumNeutralCurrentDemand", 'V', ModbusDataTypes::FLOAT, array(106, 107));
        $registers[42] = new ModbusParameter("Line1ToLine2Volts", 'V', ModbusDataTypes::FLOAT, array(200, 201));
        $registers[43] = new ModbusParameter("Line2ToLine3Volts", 'V', ModbusDataTypes::FLOAT, array(202, 203));
        $registers[44] = new ModbusParameter("Line3ToLine1Volts", 'V', ModbusDataTypes::FLOAT, array(204, 205));
        $registers[45] = new ModbusParameter("AverageLineToLineVolts", 'V', ModbusDataTypes::FLOAT, array(206, 207));
        $registers[46] = new ModbusParameter("NeutralCurrent", 'V', ModbusDataTypes::FLOAT, array(224, 225));
        $registers[47] = new ModbusParameter("Phase1L/NVoltsThd", 'V', ModbusDataTypes::FLOAT, array(234, 235));
        $registers[48] = new ModbusParameter("Phase2L/NVoltsThd", 'V', ModbusDataTypes::FLOAT, array(236, 237));
        $registers[49] = new ModbusParameter("Phase3L/NVoltsThd", 'V', ModbusDataTypes::FLOAT, array(238, 239));
        $registers[50] = new ModbusParameter("Phase1CurrentThd", 'V', ModbusDataTypes::FLOAT, array(240, 241));
        $registers[51] = new ModbusParameter("Phase2CurrentThd", 'V', ModbusDataTypes::FLOAT, array(242, 243));
        $registers[52] = new ModbusParameter("Phase3CurrentThd", 'V', ModbusDataTypes::FLOAT, array(244, 245));
        $registers[53] = new ModbusParameter("AverageLineToNeutralVoltsThd", 'V', ModbusDataTypes::FLOAT, array(248, 249));
        $registers[54] = new ModbusParameter("AverageLineCurrentThd", 'V', ModbusDataTypes::FLOAT, array(250, 251));
        $registers[55] = new ModbusParameter("Phase1CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(257, 258));
        $registers[56] = new ModbusParameter("Phase2CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(259, 260));
        $registers[57] = new ModbusParameter("Phase3CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(261, 262));
        $registers[58] = new ModbusParameter("MaximumPhase1CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(263, 264));
        $registers[59] = new ModbusParameter("MaximumPhase2CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(265, 266));
        $registers[60] = new ModbusParameter("MaximumPhase3CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(267, 268));
        $registers[61] = new ModbusParameter("Line1ToLine2VoltsThd", 'V', ModbusDataTypes::FLOAT, array(333, 334));
        $registers[62] = new ModbusParameter("Line2ToLine3VoltsThd", 'V', ModbusDataTypes::FLOAT, array(335, 336));
        $registers[63] = new ModbusParameter("Line3ToLine1VoltsThd", 'V', ModbusDataTypes::FLOAT, array(337, 338));
        $registers[64] = new ModbusParameter("AverageLineToLineVoltsThd", 'V', ModbusDataTypes::FLOAT, array(339, 340));
        $registers[65] = new ModbusParameter("TotalKwh", 'V', ModbusDataTypes::FLOAT, array(341, 342));
        $registers[66] = new ModbusParameter("TotalKvarh", 'V', ModbusDataTypes::FLOAT, array(343, 344));
        $registers[67] = new ModbusParameter("L1ImportKwh", 'V', ModbusDataTypes::FLOAT, array(345, 346));
        $registers[68] = new ModbusParameter("L2ImportKwh", 'V', ModbusDataTypes::FLOAT, array(347, 348));
        $registers[69] = new ModbusParameter("L3ImportKwh", 'V', ModbusDataTypes::FLOAT, array(349, 350));
        $registers[70] = new ModbusParameter("L1ExportKwh", 'V', ModbusDataTypes::FLOAT, array(351, 352));
        $registers[71] = new ModbusParameter("L2ExportKwh", 'V', ModbusDataTypes::FLOAT, array(353, 354));
        $registers[72] = new ModbusParameter("L3ExportKwh", 'V', ModbusDataTypes::FLOAT, array(355, 356));
        $registers[73] = new ModbusParameter("L1TotalKwh", 'V', ModbusDataTypes::FLOAT, array(357, 358));
        $registers[74] = new ModbusParameter("L2TotalKwh", 'V', ModbusDataTypes::FLOAT, array(359, 360));
        $registers[75] = new ModbusParameter("L3TotalKwh", 'V', ModbusDataTypes::FLOAT, array(361, 362));
        $registers[76] = new ModbusParameter("L1ImportKvarh", 'V', ModbusDataTypes::FLOAT, array(363, 364));
        $registers[77] = new ModbusParameter("L2ImportKvarh", 'V', ModbusDataTypes::FLOAT, array(365, 366));
        $registers[78] = new ModbusParameter("L3ImportKvarh", 'V', ModbusDataTypes::FLOAT, array(367, 368));
        $registers[79] = new ModbusParameter("L1ExportKvarh", 'V', ModbusDataTypes::FLOAT, array(369, 370));
        $registers[80] = new ModbusParameter("L2ExportKvarh", 'V', ModbusDataTypes::FLOAT, array(371, 372));
        $registers[81] = new ModbusParameter("L3ExportKvarh", 'V', ModbusDataTypes::FLOAT, array(373, 374));
        $registers[82] = new ModbusParameter("L1TotalKvarh", 'V', ModbusDataTypes::FLOAT, array(375, 376));
        $registers[83] = new ModbusParameter("L2TotalKvarh", 'V', ModbusDataTypes::FLOAT, array(377, 378));
        $registers[84] = new ModbusParameter("L3TotalKvarh", 'V', ModbusDataTypes::FLOAT, array(379, 380));

        return ModbusDeviceFactory::makeDevice($registers);
    }

    /**
     * Generate DelcosPro device.
     * @see ...
     * @return mixed
     */
    public static function DelcosPro()
    {
        /** @var array $registers Registers description.*/
        $registers = array();

        $registers[0] = new ModbusParameter("SpeedTarget", 'RPM', ModbusDataTypes::UINT16_T, array(35));
        $registers[1] = new ModbusParameter("CurrentMotor", 'A/10', ModbusDataTypes::UINT16_T, array(36));
        $registers[2] = new ModbusParameter("TemperatureHeatsink", 'DegC', ModbusDataTypes::INT16_T, array(37));
        $registers[3] = new ModbusParameter("VoltageDCLink", 'V', ModbusDataTypes::UINT16_T, array(38));
        $registers[4] = new ModbusParameter("SpeedMotorPercentage", 'Percentage', ModbusDataTypes::UINT16_T, array(39));
        $registers[5] = new ModbusParameter("SpeedMotorRPM ", 'RPM', ModbusDataTypes::UINT16_T, array(40));
        $registers[6] = new ModbusParameter("PowerMotorShaft", 'W', ModbusDataTypes::UINT16_T, array(41));
        $registers[7] = new ModbusParameter("PowerCompressorConsumption", 'W', ModbusDataTypes::UINT16_T, array(42));
        $registers[8] = new ModbusParameter("VolumeCompressorPercentage", 'Percentage', ModbusDataTypes::UINT16_T, array(43));
        $registers[9] = new ModbusParameter("VolumeCompressorCubics", 'CubicsPerMin/10', ModbusDataTypes::UINT16_T, array(44));
        $registers[10] = new ModbusParameter("VolumeGroupCubics", 'CubicsPerMin/10', ModbusDataTypes::UINT16_T, array(45));
        $registers[11] = new ModbusParameter("PressureStage1Output", 'mbar', ModbusDataTypes::INT16_T, array(46));
        $registers[12] = new ModbusParameter("PressureLine", 'mbar', ModbusDataTypes::INT16_T, array(47));
        $registers[13] = new ModbusParameter("TemperatureStage1Output", 'DegC', ModbusDataTypes::INT16_T, array(48));

        $registers[14] = new ModbusParameter("Status1", "BitMatrix", ModbusDataTypes::UINT16_T, array(49));
        $registers[15] = new ModbusParameter("Status2", "BitMatrix", ModbusDataTypes::UINT16_T, array(50));
        $registers[16] = new ModbusParameter("StartInhibitSource", "BitMatrix", ModbusDataTypes::UINT16_T, array(51));
        $registers[17] = new ModbusParameter("DI 31..16", "BitMatrix", ModbusDataTypes::UINT16_T, array(52));
        $registers[18] = new ModbusParameter("DI 15..0", "BitMatrix", ModbusDataTypes::UINT16_T, array(53));
        $registers[19] = new ModbusParameter("DO 31..16", "BitMatrix", ModbusDataTypes::UINT16_T, array(54));
        $registers[20] = new ModbusParameter("DO 15..0", "BitMatrix", ModbusDataTypes::UINT16_T, array(55));
        $registers[21] = new ModbusParameter("AO 0 (0..max)", "V",ModbusDataTypes::UINT16_T, array(56));
        $registers[22] = new ModbusParameter("AO 1 (0..max)", "V", ModbusDataTypes::UINT16_T, array(57));

        return ModbusDeviceFactory::makeDevice($registers);
    }

    #endregion

    #region Private Methods

    /**
     * Compose MODBUS device.
     * @param $registers
     * @return mixed
     */
    private static function makeDevice($registers)
    {
        return new ModbusDevice($registers);
    }

    #endregion

}
