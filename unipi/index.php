<?php

// Neuron API.
require_once('Neuron.php');

// SDM120 API.
require_once('SDM120.php');

// SDM630 API.
require_once('SDM630.php');

// Start

// From DB.
$ip = "176.33.1.25";
//$ip = "10.0.0.111";
$port = 8080;
$device_id = 2;
$uart = "UART_1";

// Master device.
$neuron = new Neuron($ip, $port);
// 
$neuron->update();
//$neuron->turnLedOff();
//$neuron->turnLedOn();
//$neuron->setUartRegister("UART_1", 2, 0, 0);
//$neuron->setUartRegister("UART_1", 2, 1, 0);

$sdm120_registers_indexes = SDM120::getRegistersIDs();
$sdm120_registers_data = $neuron->getUartRegisters($uart, $device_id, $sdm120_registers_indexes);
// Slave device.
$sdm120 = new SDM120($sdm120_registers_data); 


$sdm630_registers_indexes = SDM630::getRegistersIDs();
$sdm630_registers_data = $neuron->getUartRegisters($uart, $device_id, $sdm630_registers_indexes);
// Slave device.
$sdm630 = new SDM630($sdm630_registers_data); 

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SDM120 - 2</title>
    </head>
    <body>
        <br>
        <font size="5">1 phase</font>
        <br>
        <table>
            <col width="170">
            <col width="160">
            <col width="60">
            <tr>
                <th>Name</th>
                <th>Value</th>
                <th>Unit</th>
            </tr>
            <tr>
                <td>Voltage</td>
                <td><?php echo number_format($sdm120->getVoltage(), 3); ?></td>
                <td>[V]<td>
            </tr>
            <tr>
                <td>Current</td>
                <td><?php echo number_format($sdm120->getCurrent(), 3); ?></td> 
                <td>[A]</td>
            </tr>
            <tr>
                <td>Active Power</td>
                <td><?php echo number_format($sdm120->getActivePower(), 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Apparent Power</td>
                <td><?php echo number_format($sdm120->getApparentPower(), 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Reactive Power</td>
                <td><?php echo number_format($sdm120->getReactivePower(), 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Power Factor</td>
                <td><?php echo number_format($sdm120->getPowerFactor(), 3); ?></td>
                <td>[&#176]</td>
            </tr>
            <tr>
                <td>Frequency</td>
                <td><?php echo number_format($sdm120->getFrequency(), 3); ?></td>
                <td>[Hz]</td>
            </tr>
            <tr>
                <td>Import Active Energy</td>
                <td><?php echo number_format($sdm120->getImportActiveEnergy(), 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Export Active Energy</td>
                <td><?php echo number_format( $sdm120->getExportActiveEnergy(), 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Import Reactive Energy</td>
                <td><?php echo number_format($sdm120->getImportReactiveEnergy(), 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Export Reactive Energy</td>
                <td><?php echo number_format( $sdm120->getExportReactiveEnergy(), 3); ?></td>
                <td>[W]</td>
            </tr>
        </table>
        <br>
        <br>
        <font size="5">3 phase</font>
        <br>
        <table>
            <col width="150">
            <col width="60">
            <col width="60">
            <col width="60">
            <col width="60">
            <tr>
                <th>Name</th>
                <th>L1</th>
                <th>L2</th>
                <th>L3</th>
                <th>Unit</th>
            </tr>
            <tr>
                <td>Voltage</td>
                <td><?php echo number_format($sdm630->getPhase1Voltage(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase2Voltage(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase3Voltage(), 3); ?></td>
                <td>[V]<td>
            </tr>
            <tr>
                <td>Current</td>
                <td><?php echo number_format($sdm630->getPhase1Current(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase2Current(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase3Current(), 3); ?></td>
                <td>[A]<td>
            </tr>
            <tr>
                <td>Power</td>
                <td><?php echo number_format($sdm630->getPhase1Power(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase2Power(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase3Power(), 3); ?></td>
                <td>[W]<td>
            </tr>
            <tr>
                <td>Volt amps.</td>
                <td><?php echo number_format($sdm630->getPhase1VA(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase2VA(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase3VA(), 3); ?></td>
                <td>[VA]<td>
            </tr>
            <tr>
                <td>Volt amps reactive</td>
                <td><?php echo number_format($sdm630->getPhase1VAReactive(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase2VAReactive(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase3VAReactive(), 3); ?></td>
                <td>[VAr]<td>
            </tr>
            <tr>
                <td>Power factor</td>
                <td><?php echo number_format($sdm630->getPhase1PowerFactor(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase2PowerFactor(), 3); ?></td>
                <td><?php echo number_format($sdm630->getPhase3PowerFactor(), 3); ?></td>
                <td>[&#176]<td>
            </tr>
        </table>
        <br>
        <input type="button" value="Refresh Page" onClick="window.location.reload()">
    </body>
</html> 