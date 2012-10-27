<?php 

$prices = array(
    '100000' => '< 100000',
    '200000' => '> 100000 and < 200000',
    '500000' => '> 200000 and < 500000',
    '500001' => '> 500000'
);

$kms = array(
    '100' => '< 100KM',
    '200' => '> 100 and < 200 KM',
    '500' => '> 200 and < 500 KM',
    '501' => '> 500KM'
);

$ps = array(
    '100' => '< 100PS',
    '200' => '> 100 and < 200 PS',
    '500' => '> 200 and < 500 PS',
    '501' => '> 500PS'
);

$colours = array(
    'black' => 'black',
    'blue' => 'blue',
    'red' => 'red',
    'silver' => 'silver',
    'white' => 'white'
);

$sts = range(1, 10);
$seats = array();
foreach ($sts as $key => $seat) {
  $seats[$seat] = $seat;
}

$yrs = range(1990, date('Y'));
$years = array();
foreach ($yrs as $key => $year) {
  $years[$year] = $year;
}

echo $this->Html->tag('h3', __('Detailed Search'), array());

echo $this->Form->create('Car', array(
    'url' => array(
        'controller' => 'cars',
        'action' => 'search_results'
    ),
    'type' => 'GET',
    'inputDefaults' => array(
        'div' => FALSE,
        'label' => FALSE
    )
));

echo $this->Form->label('Text');
echo $this->Form->text('text') . '<br>';

$brds = $this->Form->select('brand[]', $brands, array('empty' => '...'));
$brdsLegend = $this->Html->tag('legend', 'Brands');
echo $this->Html->tag('fieldset', $brdsLegend . $brds  . ' OR ' . $brds . ' OR ' . $brds, array('escape' => FALSE));

$ctries = $this->Form->label('Country') . $this->Form->select('country', $countries, array('empty' => '...'));
$regs = $this->Form->label('Region') . $this->Form->select('region', $regions, array('empty' => '...'));
$twns = $this->Form->label('Town') . $this->Form->select('town', $towns, array('empty' => '...'));
$locationLegend = $this->Html->tag('legend', 'Location');
echo $this->Html->tag('fieldset', $locationLegend . $ctries . $regs . $twns, array('escape' => FALSE));

$prMin = $this->Form->text('price_min');
$prMax = $this->Form->text('price_max');
$priceLegend = $this->Html->tag('legend', 'Price');
echo $this->Html->tag('fieldset', $priceLegend . 'Von ' . $prMin . 'Bis ' . $prMax, array('escape' => FALSE));

$kmOne = $this->Form->text('kms_min');
$kmTwo = $this->Form->text('kms_max');
$kmLegend = $this->Html->tag('legend', 'Mileage');
echo $this->Html->tag('fieldset', $kmLegend . 'Von ' . $kmOne . 'Bis ' . $kmTwo, array('escape' => FALSE));

$psMin = $this->Form->text('power_min');
$psMax = $this->Form->text('power_max');
$powerLegend = $this->Html->tag('legend', 'Power');
echo $this->Html->tag('fieldset', $powerLegend . 'Von ' . $psMin . 'Bis ' . $psMax, array('escape' => FALSE));

$seatsMin = $this->Form->select('seats_min', $seats, array('multiple' => FALSE, 'empty' => '...'));
$seatsMax = $this->Form->select('seats_max', $seats, array('multiple' => FALSE, 'empty' => '...'));
$seatLegend = $this->Html->tag('legend', 'Seats');
echo $this->Html->tag('fieldset', $seatLegend . 'Von ' . $seatsMin . ' Bis ' . $seatsMax, array('escape' => FALSE));

$fuelsTxt = $this->Form->select('fuels', $fuels, array('multiple' => 'checkbox', 'hiddenField' => FALSE));
$fuelsLegend = $this->Html->tag('legend', 'Fuels');
echo $this->Html->tag('fieldset', $fuelsLegend . $fuelsTxt, array('escape' => FALSE));

$yearsMin = $this->Form->select('year_min', $years, array('multiple' => FALSE, 'empty' => '...'));
$yearsMax = $this->Form->select('year_max', $years, array('multiple' => FALSE, 'empty' => '...'));
$yearsLegend = $this->Html->tag('legend', 'Year');
echo $this->Html->tag('fieldset', $yearsLegend . 'Von ' . $yearsMin . ' Bis ' . $yearsMax, array('escape' => FALSE));

$coloursTxt = $this->Form->select('colours', $colours, array('multiple' => 'checkbox'));
$coloursLegend = $this->Html->tag('legend', 'Colours');
echo $this->Html->tag('fieldset', $coloursLegend . $coloursTxt, array('escape' => FALSE));

echo $this->Form->end('Search');
?>