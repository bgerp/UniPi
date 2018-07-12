<?php

require_once ("ModbusDataTypes.php");
require_once ("ModbusRegister.php");
require_once ("ModbusDevice.php");


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

        $registers[0] = new ModbusRegister('Voltage', 'V', ModbusDataTypes::FLOAT, array(0, 1));
        $registers[1] = new ModbusRegister('Current', 'A', ModbusDataTypes::FLOAT, array(6, 7));
        $registers[2] = new ModbusRegister('ActivePower', 'W', ModbusDataTypes::FLOAT, array(12, 13));
        $registers[3] = new ModbusRegister('ApparentPower', 'VA', ModbusDataTypes::FLOAT, array(18, 19));
        $registers[4] = new ModbusRegister('ReactivePower', 'VAr', ModbusDataTypes::FLOAT, array(24, 25));
        $registers[5] = new ModbusRegister('PowerFactor', 'DEG', ModbusDataTypes::FLOAT, array(30, 31));
        $registers[6] = new ModbusRegister('Frequency', 'Hz', ModbusDataTypes::FLOAT, array(70, 71));
        $registers[7] = new ModbusRegister('ImportActiveEnergy', 'kWr', ModbusDataTypes::FLOAT, array(74, 75));
        $registers[8] = new ModbusRegister('ExportActiveEnergy', 'kWr', ModbusDataTypes::FLOAT, array(76, 77));
        $registers[9] = new ModbusRegister('ImportReactiveEnergy', 'kvarh', ModbusDataTypes::FLOAT, array(78, 79));
        $registers[10] = new ModbusRegister('ExportReactiveEnergy', 'kvarh', ModbusDataTypes::FLOAT, array(84, 85));
        $registers[11] = new ModbusRegister('TotalSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(86, 86));
        $registers[12] = new ModbusRegister('MaximumTotalSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(88, 89));
        $registers[13] = new ModbusRegister('ImportSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(90, 91));
        $registers[14] = new ModbusRegister('MaximumImportSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(92, 93));
        $registers[15] = new ModbusRegister('ExportSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(94, 95));
        $registers[16] = new ModbusRegister('MaximumExportSystemPowerDemand', 'W', ModbusDataTypes::FLOAT, array(257, 258));
        $registers[17] = new ModbusRegister('CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(263, 264));
        $registers[18] = new ModbusRegister('MaximumCurrentDemand', 'W', ModbusDataTypes::FLOAT, array(341, 342));
        $registers[19] = new ModbusRegister('TotalActiveEnergy', 'Kvarh', ModbusDataTypes::FLOAT, array(343, 344));

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

        $registers[0] = new ModbusRegister("Phase1LineToNeutralVolts", 'V', ModbusDataTypes::FLOAT, array(0, 1));
        $registers[1] = new ModbusRegister("Phase2LineToNeutralVolts", 'V', ModbusDataTypes::FLOAT, array(2, 3));
        $registers[2] = new ModbusRegister("Phase3LineToNeutralVolts", 'V', ModbusDataTypes::FLOAT, array(4, 5));
        $registers[3] = new ModbusRegister("Phase1Current", 'V', ModbusDataTypes::FLOAT, array(6, 7));
        $registers[4] = new ModbusRegister("Phase2Current", 'V', ModbusDataTypes::FLOAT, array(8, 9));
        $registers[5] = new ModbusRegister("Phase3Current", 'V', ModbusDataTypes::FLOAT, array(10, 11));
        $registers[6] = new ModbusRegister("Phase1Power", 'V', ModbusDataTypes::FLOAT, array(12, 13));
        $registers[7] = new ModbusRegister("Phase2Power", 'V', ModbusDataTypes::FLOAT, array(14, 15));
        $registers[8] = new ModbusRegister("Phase3Power", 'V', ModbusDataTypes::FLOAT, array(16, 17));
        $registers[9] = new ModbusRegister("Phase1VoltAmps", 'V', ModbusDataTypes::FLOAT, array(18, 19));
        $registers[10] = new ModbusRegister("Phase2VoltAmps", 'V', ModbusDataTypes::FLOAT, array(20, 21));
        $registers[11] = new ModbusRegister("Phase3VoltAmps", 'V', ModbusDataTypes::FLOAT, array(22, 23));
        $registers[12] = new ModbusRegister("Phase1VoltAmpsReactive", 'V', ModbusDataTypes::FLOAT, array(24, 25));
        $registers[13] = new ModbusRegister("Phase2VoltAmpsReactive", 'V', ModbusDataTypes::FLOAT, array(26, 27));
        $registers[14] = new ModbusRegister("Phase3VoltAmpsReactive", 'V', ModbusDataTypes::FLOAT, array(28, 29));
        $registers[15] = new ModbusRegister("Phase1PowerFactor", 'V', ModbusDataTypes::FLOAT, array(30, 31));
        $registers[16] = new ModbusRegister("Phase2PowerFactor", 'V', ModbusDataTypes::FLOAT, array(32, 33));
        $registers[17] = new ModbusRegister("Phase3PowerFactor", 'V', ModbusDataTypes::FLOAT, array(34, 35));
        $registers[18] = new ModbusRegister("Phase1PhaseAngle", 'V', ModbusDataTypes::FLOAT, array(36, 37));
        $registers[19] = new ModbusRegister("Phase2PhaseAngle", 'V', ModbusDataTypes::FLOAT, array(38, 39));
        $registers[20] = new ModbusRegister("Phase3PhaseAngle", 'V', ModbusDataTypes::FLOAT, array(40, 41));
        $registers[21] = new ModbusRegister("AverageLineToNeutralVolts", 'V', ModbusDataTypes::FLOAT, array(42, 43));
        $registers[22] = new ModbusRegister("AverageLineCurrent", 'V', ModbusDataTypes::FLOAT, array(46, 47));
        $registers[23] = new ModbusRegister("SumOfLineCurrents", 'V', ModbusDataTypes::FLOAT, array(48, 49));
        $registers[24] = new ModbusRegister("TotalSystemPower", 'V', ModbusDataTypes::FLOAT, array(52, 53));
        $registers[25] = new ModbusRegister("TotalSystemVoltAmps", 'V', ModbusDataTypes::FLOAT, array(56, 57));
        $registers[26] = new ModbusRegister("TotalSystemVar", 'V', ModbusDataTypes::FLOAT, array(60, 61));
        $registers[27] = new ModbusRegister("TotalSystemPowerFactor", 'V', ModbusDataTypes::FLOAT, array(62, 63));
        $registers[28] = new ModbusRegister("TotalSystemPhaseAngle", 'V', ModbusDataTypes::FLOAT, array(66, 67));
        $registers[29] = new ModbusRegister("FrequencyOfSupplyVoltages", 'V', ModbusDataTypes::FLOAT, array(70, 71));
        $registers[30] = new ModbusRegister("TotalImportKwh", 'V', ModbusDataTypes::FLOAT, array(72, 73));
        $registers[31] = new ModbusRegister("TotalExportKwh", 'V', ModbusDataTypes::FLOAT, array(74, 75));
        $registers[32] = new ModbusRegister("TotalImportKvarh", 'V', ModbusDataTypes::FLOAT, array(76, 77));
        $registers[33] = new ModbusRegister("TotalExportKvarh", 'V', ModbusDataTypes::FLOAT, array(78, 79));
        $registers[34] = new ModbusRegister("TotalVah", 'V', ModbusDataTypes::FLOAT, array(80, 81));
        $registers[35] = new ModbusRegister("Ah", 'V', ModbusDataTypes::FLOAT, array(82, 83));
        $registers[36] = new ModbusRegister("TotalSystemPowerDemand", 'V', ModbusDataTypes::FLOAT, array(84, 85));
        $registers[37] = new ModbusRegister("MaximumTotalSystemPowerDemand", 'V', ModbusDataTypes::FLOAT, array(86, 87));
        $registers[38] = new ModbusRegister("TotalSystemVaDemand", 'V', ModbusDataTypes::FLOAT, array(100, 101));
        $registers[39] = new ModbusRegister("MaximumTotalSystemVaDemand", 'V', ModbusDataTypes::FLOAT, array(102, 103));
        $registers[40] = new ModbusRegister("NeutralCurrentDemand", 'V', ModbusDataTypes::FLOAT, array(104, 105));
        $registers[41] = new ModbusRegister("MaximumNeutralCurrentDemand", 'V', ModbusDataTypes::FLOAT, array(106, 107));
        $registers[42] = new ModbusRegister("Line1ToLine2Volts", 'V', ModbusDataTypes::FLOAT, array(200, 201));
        $registers[43] = new ModbusRegister("Line2ToLine3Volts", 'V', ModbusDataTypes::FLOAT, array(202, 203));
        $registers[44] = new ModbusRegister("Line3ToLine1Volts", 'V', ModbusDataTypes::FLOAT, array(204, 205));
        $registers[45] = new ModbusRegister("AverageLineToLineVolts", 'V', ModbusDataTypes::FLOAT, array(206, 207));
        $registers[46] = new ModbusRegister("NeutralCurrent", 'V', ModbusDataTypes::FLOAT, array(224, 225));
        $registers[47] = new ModbusRegister("Phase1L/NVoltsThd", 'V', ModbusDataTypes::FLOAT, array(234, 235));
        $registers[48] = new ModbusRegister("Phase2L/NVoltsThd", 'V', ModbusDataTypes::FLOAT, array(236, 237));
        $registers[49] = new ModbusRegister("Phase3L/NVoltsThd", 'V', ModbusDataTypes::FLOAT, array(238, 239));
        $registers[50] = new ModbusRegister("Phase1CurrentThd", 'V', ModbusDataTypes::FLOAT, array(240, 241));
        $registers[51] = new ModbusRegister("Phase2CurrentThd", 'V', ModbusDataTypes::FLOAT, array(242, 243));
        $registers[52] = new ModbusRegister("Phase3CurrentThd", 'V', ModbusDataTypes::FLOAT, array(244, 245));
        $registers[53] = new ModbusRegister("AverageLineToNeutralVoltsThd", 'V', ModbusDataTypes::FLOAT, array(248, 249));
        $registers[54] = new ModbusRegister("AverageLineCurrentThd", 'V', ModbusDataTypes::FLOAT, array(250, 251));
        $registers[55] = new ModbusRegister("Phase1CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(257, 258));
        $registers[56] = new ModbusRegister("Phase2CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(259, 260));
        $registers[57] = new ModbusRegister("Phase3CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(261, 262));
        $registers[58] = new ModbusRegister("MaximumPhase1CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(263, 264));
        $registers[59] = new ModbusRegister("MaximumPhase2CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(265, 266));
        $registers[60] = new ModbusRegister("MaximumPhase3CurrentDemand", 'V', ModbusDataTypes::FLOAT, array(267, 268));
        $registers[61] = new ModbusRegister("Line1ToLine2VoltsThd", 'V', ModbusDataTypes::FLOAT, array(333, 334));
        $registers[62] = new ModbusRegister("Line2ToLine3VoltsThd", 'V', ModbusDataTypes::FLOAT, array(335, 336));
        $registers[63] = new ModbusRegister("Line3ToLine1VoltsThd", 'V', ModbusDataTypes::FLOAT, array(337, 338));
        $registers[64] = new ModbusRegister("AverageLineToLineVoltsThd", 'V', ModbusDataTypes::FLOAT, array(339, 340));
        $registers[65] = new ModbusRegister("TotalKwh", 'V', ModbusDataTypes::FLOAT, array(341, 342));
        $registers[66] = new ModbusRegister("TotalKvarh", 'V', ModbusDataTypes::FLOAT, array(343, 344));
        $registers[67] = new ModbusRegister("L1ImportKwh", 'V', ModbusDataTypes::FLOAT, array(345, 346));
        $registers[68] = new ModbusRegister("L2ImportKwh", 'V', ModbusDataTypes::FLOAT, array(347, 348));
        $registers[69] = new ModbusRegister("L3ImportKwh", 'V', ModbusDataTypes::FLOAT, array(349, 350));
        $registers[70] = new ModbusRegister("L1ExportKwh", 'V', ModbusDataTypes::FLOAT, array(351, 352));
        $registers[71] = new ModbusRegister("L2ExportKwh", 'V', ModbusDataTypes::FLOAT, array(353, 354));
        $registers[72] = new ModbusRegister("L3ExportKwh", 'V', ModbusDataTypes::FLOAT, array(355, 356));
        $registers[73] = new ModbusRegister("L1TotalKwh", 'V', ModbusDataTypes::FLOAT, array(357, 358));
        $registers[74] = new ModbusRegister("L2TotalKwh", 'V', ModbusDataTypes::FLOAT, array(359, 360));
        $registers[75] = new ModbusRegister("L3TotalKwh", 'V', ModbusDataTypes::FLOAT, array(361, 362));
        $registers[76] = new ModbusRegister("L1ImportKvarh", 'V', ModbusDataTypes::FLOAT, array(363, 364));
        $registers[77] = new ModbusRegister("L2ImportKvarh", 'V', ModbusDataTypes::FLOAT, array(365, 366));
        $registers[78] = new ModbusRegister("L3ImportKvarh", 'V', ModbusDataTypes::FLOAT, array(367, 368));
        $registers[79] = new ModbusRegister("L1ExportKvarh", 'V', ModbusDataTypes::FLOAT, array(369, 370));
        $registers[80] = new ModbusRegister("L2ExportKvarh", 'V', ModbusDataTypes::FLOAT, array(371, 372));
        $registers[81] = new ModbusRegister("L3ExportKvarh", 'V', ModbusDataTypes::FLOAT, array(373, 374));
        $registers[82] = new ModbusRegister("L1TotalKvarh", 'V', ModbusDataTypes::FLOAT, array(375, 376));
        $registers[83] = new ModbusRegister("L2TotalKvarh", 'V', ModbusDataTypes::FLOAT, array(377, 378));
        $registers[84] = new ModbusRegister("L3TotalKvarh", 'V', ModbusDataTypes::FLOAT, array(379, 380));

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

        $registers[0] = new ModbusRegister("SpeedTarget", 'RPM', ModbusDataTypes::UINT16_T, array(35));
        $registers[1] = new ModbusRegister("CurrentMotor", 'A/10', ModbusDataTypes::UINT16_T, array(36));
        $registers[2] = new ModbusRegister("TemperatureHeatsink", 'DegC', ModbusDataTypes::INT16_T, array(37));
        $registers[3] = new ModbusRegister("VoltageDCLink", 'V', ModbusDataTypes::UINT16_T, array(38));
        $registers[4] = new ModbusRegister("SpeedMotorPercentage", 'Percentage', ModbusDataTypes::UINT16_T, array(39));
        $registers[5] = new ModbusRegister("SpeedMotorRPM ", 'RPM', ModbusDataTypes::UINT16_T, array(40));
        $registers[6] = new ModbusRegister("PowerMotorShaft", 'W', ModbusDataTypes::UINT16_T, array(41));
        $registers[7] = new ModbusRegister("PowerCompressorConsumption", 'W', ModbusDataTypes::UINT16_T, array(42));
        $registers[8] = new ModbusRegister("VolumeCompressorPercentage", 'Percentage', ModbusDataTypes::UINT16_T, array(43));
        $registers[9] = new ModbusRegister("VolumeCompressorCubics", 'CubicsPerMin/10', ModbusDataTypes::UINT16_T, array(44));
        $registers[10] = new ModbusRegister("VolumeGroupCubics", 'CubicsPerMin/10', ModbusDataTypes::UINT16_T, array(45));
        $registers[11] = new ModbusRegister("PressureStage1Output", 'mbar', ModbusDataTypes::INT16_T, array(46));
        $registers[12] = new ModbusRegister("PressureLine", 'mbar', ModbusDataTypes::INT16_T, array(47));
        $registers[13] = new ModbusRegister("TemperatureStage1Output", 'DegC', ModbusDataTypes::INT16_T, array(48));

        $registers[14] = new ModbusRegister("Status1", "BitMatrix", ModbusDataTypes::UINT16_T, array(49));
        $registers[15] = new ModbusRegister("Status2", "BitMatrix", ModbusDataTypes::UINT16_T, array(50));
        $registers[16] = new ModbusRegister("StartInhibitSource", "BitMatrix", ModbusDataTypes::UINT16_T, array(51));
        $registers[17] = new ModbusRegister("DI 31..16", "BitMatrix", ModbusDataTypes::UINT16_T, array(52));
        $registers[18] = new ModbusRegister("DI 15..0", "BitMatrix", ModbusDataTypes::UINT16_T, array(53));
        $registers[19] = new ModbusRegister("DO 31..16", "BitMatrix", ModbusDataTypes::UINT16_T, array(54));
        $registers[20] = new ModbusRegister("DO 15..0", "BitMatrix", ModbusDataTypes::UINT16_T, array(55));
        $registers[21] = new ModbusRegister("AO 0 (0..max)", "V",ModbusDataTypes::UINT16_T, array(56));
        $registers[22] = new ModbusRegister("AO 1 (0..max)", "V", ModbusDataTypes::UINT16_T, array(57));

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
