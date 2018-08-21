<?php

require_once ('ModbusDevice.php');

/**
 * This class is dedicated to read data from SDM630 energy meter.
 *
 * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
 */
class SDM630 extends ModbusDevice
{

    #region Constructor

    /**
     * SDM120 constructor.
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
         * @var array Registers description. Page 2 - 5.
         * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
         */
        $registers = array();

        $registers[0] = new ModbusParameter('Phase1LineToNeutralVolts', 'V', ModbusDataTypes::FLOAT, array(0, 1));
        $registers[1] = new ModbusParameter('Phase2LineToNeutralVolts', 'V', ModbusDataTypes::FLOAT, array(2, 3));
        $registers[2] = new ModbusParameter('Phase3LineToNeutralVolts', 'V', ModbusDataTypes::FLOAT, array(4, 5));
        $registers[3] = new ModbusParameter('Phase1Current', 'A', ModbusDataTypes::FLOAT, array(6, 7));
        $registers[4] = new ModbusParameter('Phase2Current', 'A', ModbusDataTypes::FLOAT, array(8, 9));
        $registers[5] = new ModbusParameter('Phase3Current', 'A', ModbusDataTypes::FLOAT, array(10, 11));
        $registers[6] = new ModbusParameter('Phase1Power', 'W', ModbusDataTypes::FLOAT, array(12, 13));
        $registers[7] = new ModbusParameter('Phase2Power', 'W', ModbusDataTypes::FLOAT, array(14, 15));
        $registers[8] = new ModbusParameter('Phase3Power', 'W', ModbusDataTypes::FLOAT, array(16, 17));
        $registers[9] = new ModbusParameter('Phase1VoltAmps', 'VA', ModbusDataTypes::FLOAT, array(18, 19));
        $registers[10] = new ModbusParameter('Phase2VoltAmps', 'VA', ModbusDataTypes::FLOAT, array(20, 21));
        $registers[11] = new ModbusParameter('Phase3VoltAmps', 'VA', ModbusDataTypes::FLOAT, array(22, 23));
        $registers[12] = new ModbusParameter('Phase1VoltAmpsReactive', 'VAr', ModbusDataTypes::FLOAT, array(24, 25));
        $registers[13] = new ModbusParameter('Phase2VoltAmpsReactive', 'VAr', ModbusDataTypes::FLOAT, array(26, 27));
        $registers[14] = new ModbusParameter('Phase3VoltAmpsReactive', 'VAr', ModbusDataTypes::FLOAT, array(28, 29));
        $registers[15] = new ModbusParameter('Phase1PowerFactor', 'Deg', ModbusDataTypes::FLOAT, array(30, 31));
        $registers[16] = new ModbusParameter('Phase2PowerFactor', 'Deg', ModbusDataTypes::FLOAT, array(32, 33));
        $registers[17] = new ModbusParameter('Phase3PowerFactor', 'Deg', ModbusDataTypes::FLOAT, array(34, 35));
        $registers[18] = new ModbusParameter('Phase1PhaseAngle', 'Deg', ModbusDataTypes::FLOAT, array(36, 37));
        $registers[19] = new ModbusParameter('Phase2PhaseAngle', 'Deg', ModbusDataTypes::FLOAT, array(38, 39));
        $registers[20] = new ModbusParameter('Phase3PhaseAngle', 'Deg', ModbusDataTypes::FLOAT, array(40, 41));
        $registers[21] = new ModbusParameter('AverageLineToNeutralVolts', 'V', ModbusDataTypes::FLOAT, array(42, 43));
        $registers[22] = new ModbusParameter('AverageLineCurrent', 'A', ModbusDataTypes::FLOAT, array(46, 47));
        $registers[23] = new ModbusParameter('SumOfLineCurrents', 'A', ModbusDataTypes::FLOAT, array(48, 49));
        $registers[24] = new ModbusParameter('TotalSystemPower', 'W', ModbusDataTypes::FLOAT, array(52, 53));
        $registers[25] = new ModbusParameter('TotalSystemVoltAmps', 'VA', ModbusDataTypes::FLOAT, array(56, 57));
        $registers[26] = new ModbusParameter('TotalSystemVAr', 'VA', ModbusDataTypes::FLOAT, array(60, 61));
        $registers[27] = new ModbusParameter('TotalSystemPowerFactor', 'Deg', ModbusDataTypes::FLOAT, array(62, 63));
        $registers[28] = new ModbusParameter('TotalSystemPhaseAngle', 'Deg', ModbusDataTypes::FLOAT, array(66, 67));
        $registers[29] = new ModbusParameter('FrequencyOfSupplyVoltages', 'Hz', ModbusDataTypes::FLOAT, array(70, 71));
        $registers[30] = new ModbusParameter('TotalImportkWh', 'kWh', ModbusDataTypes::FLOAT, array(72, 73));
        $registers[31] = new ModbusParameter('TotalExportkWh', 'kWh', ModbusDataTypes::FLOAT, array(74, 75));
        $registers[32] = new ModbusParameter('TotalImportkVAarh', 'kVArh', ModbusDataTypes::FLOAT, array(76, 77));
        $registers[33] = new ModbusParameter('TotalExportkVAarh', 'kVArh', ModbusDataTypes::FLOAT, array(78, 79));
        $registers[34] = new ModbusParameter('TotalVAh', 'kVAh', ModbusDataTypes::FLOAT, array(80, 81));
        $registers[35] = new ModbusParameter('Ah', 'Ah', ModbusDataTypes::FLOAT, array(82, 83));
        $registers[36] = new ModbusParameter('TotalSystemPowerDemand', 'VA', ModbusDataTypes::FLOAT, array(84, 85));
        $registers[37] = new ModbusParameter('MaximumTotalSystemPowerDemand', 'VA', ModbusDataTypes::FLOAT, array(86, 87));
        $registers[38] = new ModbusParameter('TotalSystemVaDemand', 'VA', ModbusDataTypes::FLOAT, array(100, 101));
        $registers[39] = new ModbusParameter('MaximumTotalSystemVADemand', 'VA', ModbusDataTypes::FLOAT, array(102, 103));
        $registers[40] = new ModbusParameter('NeutralCurrentDemand', 'A', ModbusDataTypes::FLOAT, array(104, 105));
        $registers[41] = new ModbusParameter('MaximumNeutralCurrentDemand', 'A', ModbusDataTypes::FLOAT, array(106, 107));
        $registers[42] = new ModbusParameter('Line1ToLine2Volts', 'V', ModbusDataTypes::FLOAT, array(200, 201));
        $registers[43] = new ModbusParameter('Line2ToLine3Volts', 'V', ModbusDataTypes::FLOAT, array(202, 203));
        $registers[44] = new ModbusParameter('Line3ToLine1Volts', 'V', ModbusDataTypes::FLOAT, array(204, 205));
        $registers[45] = new ModbusParameter('AverageLineToLineVolts', 'V', ModbusDataTypes::FLOAT, array(206, 207));
        $registers[46] = new ModbusParameter('NeutralCurrent', 'A', ModbusDataTypes::FLOAT, array(224, 225));
        $registers[47] = new ModbusParameter('Phase1L/NVoltsThd', '%', ModbusDataTypes::FLOAT, array(234, 235));
        $registers[48] = new ModbusParameter('Phase2L/NVoltsThd', '%', ModbusDataTypes::FLOAT, array(236, 237));
        $registers[49] = new ModbusParameter('Phase3L/NVoltsThd', '%', ModbusDataTypes::FLOAT, array(238, 239));
        $registers[50] = new ModbusParameter('Phase1CurrentThd', '%', ModbusDataTypes::FLOAT, array(240, 241));
        $registers[51] = new ModbusParameter('Phase2CurrentThd', '%', ModbusDataTypes::FLOAT, array(242, 243));
        $registers[52] = new ModbusParameter('Phase3CurrentThd', '%', ModbusDataTypes::FLOAT, array(244, 245));
        $registers[53] = new ModbusParameter('AverageLineToNeutralVoltsTHD', '%', ModbusDataTypes::FLOAT, array(248, 249));
        $registers[54] = new ModbusParameter('AverageLineCurrentTHD', '%', ModbusDataTypes::FLOAT, array(250, 251));
        $registers[55] = new ModbusParameter('Phase1CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(257, 258));
        $registers[56] = new ModbusParameter('Phase2CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(259, 260));
        $registers[57] = new ModbusParameter('Phase3CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(261, 262));
        $registers[58] = new ModbusParameter('MaximumPhase1CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(263, 264));
        $registers[59] = new ModbusParameter('MaximumPhase2CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(265, 266));
        $registers[60] = new ModbusParameter('MaximumPhase3CurrentDemand', 'A', ModbusDataTypes::FLOAT, array(267, 268));
        $registers[61] = new ModbusParameter('Line1ToLine2VoltsTHD', '%', ModbusDataTypes::FLOAT, array(333, 334));
        $registers[62] = new ModbusParameter('Line2ToLine3VoltsTHD', '%', ModbusDataTypes::FLOAT, array(335, 336));
        $registers[63] = new ModbusParameter('Line3ToLine1VoltsTHD', '%', ModbusDataTypes::FLOAT, array(337, 338));
        $registers[64] = new ModbusParameter('AverageLineToLineVoltsTHD', '%', ModbusDataTypes::FLOAT, array(339, 340));
        $registers[65] = new ModbusParameter('TotalkWh', 'kWh', ModbusDataTypes::FLOAT, array(341, 342));
        $registers[66] = new ModbusParameter('TotalkVArh', 'kVArh', ModbusDataTypes::FLOAT, array(343, 344));
        $registers[67] = new ModbusParameter('L1ImportkWh', 'kWh', ModbusDataTypes::FLOAT, array(345, 346));
        $registers[68] = new ModbusParameter('L2ImportkWh', 'kWh', ModbusDataTypes::FLOAT, array(347, 348));
        $registers[69] = new ModbusParameter('L3ImportkWh', 'kWh', ModbusDataTypes::FLOAT, array(349, 350));
        $registers[70] = new ModbusParameter('L1ExportkWh', 'kWh', ModbusDataTypes::FLOAT, array(351, 352));
        $registers[71] = new ModbusParameter('L2ExportkWh', 'kWh', ModbusDataTypes::FLOAT, array(353, 354));
        $registers[72] = new ModbusParameter('L3ExportkWh', 'kWh', ModbusDataTypes::FLOAT, array(355, 356));
        $registers[73] = new ModbusParameter('L1TotalkWh', 'kWh', ModbusDataTypes::FLOAT, array(357, 358));
        $registers[74] = new ModbusParameter('L2TotalkWh', 'kWh', ModbusDataTypes::FLOAT, array(359, 360));
        $registers[75] = new ModbusParameter('L3TotalkWh', 'kWh', ModbusDataTypes::FLOAT, array(361, 362));
        $registers[76] = new ModbusParameter('L1ImportkVArh', 'kVArh', ModbusDataTypes::FLOAT, array(363, 364));
        $registers[77] = new ModbusParameter('L2ImportkVArh', 'kVArh', ModbusDataTypes::FLOAT, array(365, 366));
        $registers[78] = new ModbusParameter('L3ImportkVArh', 'kVArh', ModbusDataTypes::FLOAT, array(367, 368));
        $registers[79] = new ModbusParameter('L1ExportkVArh', 'kVArh', ModbusDataTypes::FLOAT, array(369, 370));
        $registers[80] = new ModbusParameter('L2ExportkVArh', 'kVArh', ModbusDataTypes::FLOAT, array(371, 372));
        $registers[81] = new ModbusParameter('L3ExportkVArh', 'kVArh', ModbusDataTypes::FLOAT, array(373, 374));
        $registers[82] = new ModbusParameter('L1TotalkVArh', 'kVArh', ModbusDataTypes::FLOAT, array(375, 376));
        $registers[83] = new ModbusParameter('L2TotalkVArh', 'kVArh', ModbusDataTypes::FLOAT, array(377, 378));
        $registers[84] = new ModbusParameter('L3TotalkVArh', 'kVArh', ModbusDataTypes::FLOAT, array(379, 380));

        return $registers;
    }

    #endregion

}
