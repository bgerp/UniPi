<?php

require_once ('ModbusDevice.php');

/**
 * This class is dedicated to read data from SDM120 energy meter.
 *
 * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf
 */
class SDM120 extends ModbusDevice
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
         * @var array Registers description. Page 5 - 6.
         * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf
         */
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
        $registers[19] = new ModbusParameter('TotalActiveEnergy', 'kVArh', ModbusDataTypes::FLOAT, array(343, 344));

        return $registers;
    }

    #endregion

}