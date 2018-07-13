<?php

/**
 * This class is EVOK configuration .
 */
class EvokDevCfgGenerator
{

    #region Variables

    private $content = array();

    #endregion

    #region Construcotr

    public function __construct()
    {
    }

    #endregion

    #region Getters and Setters

    /**
     * @return array
     */
    public function generateConfiguration()
    {
        return $this->content;
    }

    #endregion

    #region Public Methods

    public function addType($type)
    {
        $this->content['type'] = $type;
    }

    public function addModbusRegisterBlocks($board_index, $start_reg, $count, $frequency = 60)
    {
        $block = array();

        $block['board_index'] = $board_index;
        $block['start_reg'] = $start_reg;
        $block['count'] = $count;
        $block['frequency'] = $frequency;

        if(!isset($this->content['modbus_register_blocks']))
        {
            $this->content['modbus_register_blocks'] = array();
        }

        array_push($this->content['modbus_register_blocks'], $block);
    }

    public function addModbusFeatures($type, $major_group, $count, $start_reg)
    {
        $feture = array();

        $feture['type'] = $type;
        $feture['major_group'] = $major_group;
        $feture['count'] = $count;
        $feture['start_reg'] = $start_reg;

        if(!isset($this->content['modbus_features']))
        {
            $this->content['modbus_features'] = array();
        }

        array_push($this->content['modbus_features'], $feture);
    }

    public static function createFromRegisters($type, $board_index, $frequency, $major_group, $regsters)
    {
        $configuration = new EvokDevCfgGenerator();

        $configuration->addType($type);

        foreach ($regsters as $key => $register)
        {
            $addresses = $register->getAdresses();
            $addresses_count = count($addresses);
            $configuration->addModbusRegisterBlocks($board_index, $addresses[0], $addresses_count, $frequency);
            $configuration->addModbusFeatures('REGISTER', $major_group, $addresses_count, $addresses[0]);
        }

        return $configuration->generateConfiguration();
    }

    #endregion


}