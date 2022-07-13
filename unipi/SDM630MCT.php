<?php

require_once ('ModbusDevice.php');

/**
 * This class is dedicated to read data from SDM630MCT energy meter.
 *
 * @see https://www.eastroneurope.com/images/uploads/products/protocol/SDM630MCT_MODBUS_Protocol_V1.7.pdf
 */
class SDM630MCT extends ModbusDevice
{

    #region Constructor

    /**
     * SDM630MCT constructor.
     */
    public function __construct()
    {
        $registers = $this->createSettings();
        parent::__construct($registers);
    }

    #endregion

    #region Private Methods

    private function createSettings()
    {
        /**
         * @var array Registers description. Page 2 - 6.
         * @see https://www.eastroneurope.com/images/uploads/products/protocol/SDM630MCT_MODBUS_Protocol_V1.7.pdf
         */
        $registers = array();

        $registers[0] = new ModbusParameter('Phase1LineToNeutralVolts', 'V', ModbusDataTypes::FLOAT, array(0, 1));
        $registers[1] = new ModbusParameter('Phase2LineToNeutralVolts', 'V', ModbusDataTypes::FLOAT, array(2, 3));
        $registers[2] = new ModbusParameter('Phase3LineToNeutralVolts', 'V', ModbusDataTypes::FLOAT, array(4, 5));
        $registers[3] = new ModbusParameter('Phase1Current', 'A', ModbusDataTypes::FLOAT, array(6, 7));
        $registers[4] = new ModbusParameter('Phase2Current', 'A', ModbusDataTypes::FLOAT, array(8, 9));
        $registers[5] = new ModbusParameter('Phase3Current', 'A', ModbusDataTypes::FLOAT, array(10, 11));
        $registers[6] = new ModbusParameter('Phase1ActivePower', 'W', ModbusDataTypes::FLOAT, array(12, 13));
        $registers[7] = new ModbusParameter('Phase2ActivePower', 'W', ModbusDataTypes::FLOAT, array(14, 15));
        $registers[8] = new ModbusParameter('Phase3ActivePower', 'W', ModbusDataTypes::FLOAT, array(16, 17));
        $registers[9] = new ModbusParameter('Phase1ApparentPower', 'VA', ModbusDataTypes::FLOAT, array(18, 19));
        $registers[10] = new ModbusParameter('Phase2ApparentPower', 'VA', ModbusDataTypes::FLOAT, array(20, 21));
        $registers[11] = new ModbusParameter('Phase3ApparentPower', 'VA', ModbusDataTypes::FLOAT, array(22, 23));
        $registers[12] = new ModbusParameter('Phase1ReactivePower', 'VAr', ModbusDataTypes::FLOAT, array(24, 25));
        $registers[13] = new ModbusParameter('Phase2ReactivePower', 'VAr', ModbusDataTypes::FLOAT, array(26, 27));
        $registers[14] = new ModbusParameter('Phase3ReactivePower', 'VAr', ModbusDataTypes::FLOAT, array(28, 29));
        $registers[15] = new ModbusParameter('Phase1PowerFactor(1)', 'None', ModbusDataTypes::FLOAT, array(30, 31));
        $registers[16] = new ModbusParameter('Phase2PowerFactor(1)', 'None', ModbusDataTypes::FLOAT, array(32, 33));
        $registers[17] = new ModbusParameter('Phase3PowerFactor(1)', 'None', ModbusDataTypes::FLOAT, array(34, 35));
        $registers[18] = new ModbusParameter('Phase1PhaseAngle', 'Degrees', ModbusDataTypes::FLOAT, array(36, 37));
        $registers[19] = new ModbusParameter('Phase2PhaseAngle', 'Degrees', ModbusDataTypes::FLOAT, array(38, 39));
        $registers[20] = new ModbusParameter('Phase3PhaseAngle', 'Degrees', ModbusDataTypes::FLOAT, array(40, 41));
        $registers[21] = new ModbusParameter('AverageLineToNeutralVolts', 'V', ModbusDataTypes::FLOAT, array(42, 43));
        $registers[22] = new ModbusParameter('AverageLineCurrent', 'A', ModbusDataTypes::FLOAT, array(46, 47));
        $registers[23] = new ModbusParameter('SumOfLineCurrents', 'A', ModbusDataTypes::FLOAT, array(48, 49));
        $registers[24] = new ModbusParameter('TotalSystemPower', 'W', ModbusDataTypes::FLOAT, array(52, 53));
        $registers[25] = new ModbusParameter('TotalSystemVoltAmps', 'VA', ModbusDataTypes::FLOAT, array(56, 57));
        $registers[26] = new ModbusParameter('TotalSystemVAr', 'VAr', ModbusDataTypes::FLOAT, array(60, 61));
        $registers[27] = new ModbusParameter('TotalSystemPowerFactor(1)', 'None', ModbusDataTypes::FLOAT, array(62, 63));
        $registers[28] = new ModbusParameter('TotalSystemPhaseAngle', 'Degrees', ModbusDataTypes::FLOAT, array(66, 67));
        $registers[29] = new ModbusParameter('FrequencyOfSupplyVoltages', 'Hz', ModbusDataTypes::FLOAT, array(70, 71));
        $registers[30] = new ModbusParameter('TotalImportKWh', 'kWh', ModbusDataTypes::FLOAT, array(72, 73));
        $registers[31] = new ModbusParameter('TotalExportKWh', 'kWh', ModbusDataTypes::FLOAT, array(74, 75));
        $registers[32] = new ModbusParameter('TotalImportKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(76, 77));
        $registers[33] = new ModbusParameter('TotalExportKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(78, 79));
        $registers[34] = new ModbusParameter('TotalVAh', 'kVAh', ModbusDataTypes::FLOAT, array(80, 81));
        $registers[35] = new ModbusParameter('Ah', 'Ah', ModbusDataTypes::FLOAT, array(82, 83));
        $registers[36] = new ModbusParameter('TotalSystemPowerDemand(2)', 'W', ModbusDataTypes::FLOAT, array(84, 85));
        $registers[37] = new ModbusParameter('MaximumTotalSystemPowerDemand(2)', 'W', ModbusDataTypes::FLOAT, array(86, 87));
        $registers[38] = new ModbusParameter('TotalSystemVADemand', 'VA', ModbusDataTypes::FLOAT, array(100, 101));
        $registers[39] = new ModbusParameter('MaximumTotalSystemVADemand', 'VA', ModbusDataTypes::FLOAT, array(102, 103));
        $registers[40] = new ModbusParameter('NeutralCurrentDemand', 'Amps', ModbusDataTypes::FLOAT, array(104, 105));
        $registers[41] = new ModbusParameter('MaximumNeutralCurrentDemand', 'Amps', ModbusDataTypes::FLOAT, array(106, 107));
        $registers[42] = new ModbusParameter('TotalSystemReactivePowerDemand(2)', 'VAr', ModbusDataTypes::FLOAT, array(108, 109));
        $registers[43] = new ModbusParameter('MaximumTotalSystemReactivePowerDemand(2)', 'VAr', ModbusDataTypes::FLOAT, array(110, 111));
        $registers[44] = new ModbusParameter('Line1ToLine2Volts', 'V', ModbusDataTypes::FLOAT, array(200, 201));
        $registers[45] = new ModbusParameter('Line2ToLine3Volts', 'V', ModbusDataTypes::FLOAT, array(202, 203));
        $registers[46] = new ModbusParameter('Line3ToLine1Volts', 'V', ModbusDataTypes::FLOAT, array(204, 205));
        $registers[47] = new ModbusParameter('AverageLineToLineVolts', 'V', ModbusDataTypes::FLOAT, array(206, 207));
        $registers[48] = new ModbusParameter('NeutralCurrent', 'A', ModbusDataTypes::FLOAT, array(224, 225));
        $registers[49] = new ModbusParameter('Phase1L/NVoltsTHD', '%', ModbusDataTypes::FLOAT, array(234, 235));
        $registers[50] = new ModbusParameter('Phase2L/NVoltsTHD', '%', ModbusDataTypes::FLOAT, array(236, 237));
        $registers[51] = new ModbusParameter('Phase3L/NVoltsTHD', '%', ModbusDataTypes::FLOAT, array(238, 239));
        $registers[52] = new ModbusParameter('Phase1CurrentTHD', '%', ModbusDataTypes::FLOAT, array(240, 241));
        $registers[53] = new ModbusParameter('Phase2CurrentTHD', '%', ModbusDataTypes::FLOAT, array(242, 243));
        $registers[54] = new ModbusParameter('Phase3CurrentTHD', '%', ModbusDataTypes::FLOAT, array(244, 245));
        $registers[55] = new ModbusParameter('AverageLineToNeutralVoltsTHD', '%', ModbusDataTypes::FLOAT, array(248, 249));
        $registers[56] = new ModbusParameter('AverageLineCurrentTHD', '%', ModbusDataTypes::FLOAT, array(250, 251));
        $registers[57] = new ModbusParameter('TotalSystemPowerFactor(1)', 'Degrees', ModbusDataTypes::FLOAT, array(254, 255));
        $registers[58] = new ModbusParameter('Phase1CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(258, 259));
        $registers[59] = new ModbusParameter('Phase2CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(260, 261));
        $registers[60] = new ModbusParameter('Phase3CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(262, 263));
        $registers[61] = new ModbusParameter('MaximumPhase1CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(264, 265));
        $registers[62] = new ModbusParameter('MaximumPhase2CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(266, 267));
        $registers[63] = new ModbusParameter('MaximumPhase3CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(268, 269));
        $registers[64] = new ModbusParameter('Line1ToLine2VoltsTHD', '%', ModbusDataTypes::FLOAT, array(334, 335));
        $registers[65] = new ModbusParameter('Line2ToLine3VoltsTHD', '%', ModbusDataTypes::FLOAT, array(336, 337));
        $registers[66] = new ModbusParameter('Line3ToLine1VoltsTHD', '%', ModbusDataTypes::FLOAT, array(338, 339));
        $registers[67] = new ModbusParameter('AverageLineToLineVoltsTHD', '%', ModbusDataTypes::FLOAT, array(340, 341));
        $registers[68] = new ModbusParameter('TotalKWh(3)', 'kWh', ModbusDataTypes::FLOAT, array(342, 343));
        $registers[69] = new ModbusParameter('TotalKVArh(3)', 'kVArh', ModbusDataTypes::FLOAT, array(344, 345));
        $registers[70] = new ModbusParameter('L1ImportKWh', 'kWh', ModbusDataTypes::FLOAT, array(346, 347));
        $registers[71] = new ModbusParameter('L2ImportKWh', 'kWh', ModbusDataTypes::FLOAT, array(348, 349));
        $registers[72] = new ModbusParameter('L3ImportKWh', 'kWh', ModbusDataTypes::FLOAT, array(350, 351));
        $registers[73] = new ModbusParameter('L1ExportKWh', 'kWh', ModbusDataTypes::FLOAT, array(352, 353));
        $registers[74] = new ModbusParameter('L2ExportKWh', 'kWh', ModbusDataTypes::FLOAT, array(354, 355));
        $registers[75] = new ModbusParameter('L3ExportKWh', 'kWh', ModbusDataTypes::FLOAT, array(356, 357));
        $registers[76] = new ModbusParameter('L1TotalKWh', 'kWh', ModbusDataTypes::FLOAT, array(358, 359));
        $registers[77] = new ModbusParameter('L2TotalKWh', 'kWh', ModbusDataTypes::FLOAT, array(360, 361));
        $registers[78] = new ModbusParameter('L3TotalKWh', 'kWh', ModbusDataTypes::FLOAT, array(362, 363));
        $registers[79] = new ModbusParameter('L1ImportKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(364, 365));
        $registers[80] = new ModbusParameter('L2ImportKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(366, 367));
        $registers[81] = new ModbusParameter('L3ImportKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(368, 369));
        $registers[82] = new ModbusParameter('L1ExportKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(370, 371));
        $registers[83] = new ModbusParameter('L2ExportKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(372, 373));
        $registers[84] = new ModbusParameter('L3ExportKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(374, 375));
        $registers[85] = new ModbusParameter('L1TotalKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(376, 377));
        $registers[86] = new ModbusParameter('L2TotalKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(378, 379));
        $registers[87] = new ModbusParameter('L3TotalKVArh', 'kVArh', ModbusDataTypes::FLOAT, array(380, 381));
        $registers[88] = new ModbusParameter('ResettableTotalActiveEnergy', 'kWh', ModbusDataTypes::FLOAT, array(384, 385));
        $registers[89] = new ModbusParameter('ResettableTotalReactiveEnergy', 'kVArh', ModbusDataTypes::FLOAT, array(386, 387));
        $registers[90] = new ModbusParameter('ResettableImportActiveEnergy', 'kWh', ModbusDataTypes::FLOAT, array(388, 389));
        $registers[91] = new ModbusParameter('ResettableExportActiveEnergy', 'kWh', ModbusDataTypes::FLOAT, array(390, 391));
        $registers[92] = new ModbusParameter('ResettableImportReactiveEnergy', 'kVArh', ModbusDataTypes::FLOAT, array(392, 393));
        $registers[93] = new ModbusParameter('ResettableExportReactiveEnergy', 'kVArh', ModbusDataTypes::FLOAT, array(394, 395));

        return $registers;
    }

    #endregion

}